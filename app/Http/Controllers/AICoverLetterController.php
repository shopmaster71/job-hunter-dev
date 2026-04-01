<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AICoverLetterController extends Controller
{
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255'
        ]);

        // Получаем текущего пользователя и его профиль соискателя
        $applicant = Auth::user()?->applicant;

        if (!$applicant) {
            return response()->json([
                'success' => false,
                'error' => 'Профиль соискателя не найден'
            ], 404);
        }

        // Загружаем связанные данные
        $experiences = $applicant->getExperiences;
        $educations = $applicant->getEducations;

        // Строим промпт с персональными данными
        $prompt = $this->buildPrompt($validated, $applicant, $experiences, $educations);

        Log::info('AI Cover Letter Prompt', ['prompt' => $prompt]);

        try {
            $response = Http::timeout(60)
                ->withToken(config('services.openrouter.api_key'))
                ->withHeaders([
                    'HTTP-Referer' => request()->root(),
                    'X-Title' => 'Job Hunter - AI Cover Letter Generator',
                ])
                ->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'mistralai/Mistral-7B-Instruct-v0.1',
                    'messages' => [['role' => 'user', 'content' => $prompt]],
                    'temperature' => 0.7,
                    'max_tokens' => 600,
                    'stop' => ["С уважением,", "Подпись", "С наилучшими пожеланиями"]
                ]);

            if ($response->successful()) {
                $letter = $response->json()['choices'][0]['message']['content'];
                return response()->json(['success' => true, 'letter' => $letter]);
            }

            Log::error('OpenRouter API Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Не удалось получить ответ от ИИ'
            ], 500);

        } catch (\Exception $e) {
            Log::error('AI Generation Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'error' => 'Ошибка сети или таймаут'
            ], 500);
        }
    }

    private function buildPrompt($vacancyData, $applicant, $experiences, $educations): string
    {
        $fullName = trim("{$applicant->name} {$applicant->surname}");
        $email = $applicant->getContact->email ?? 'ваша_почта@example.com';
        $phone = $applicant->getContact->phone ?? 'не указан';

        $experienceText = $experiences->isNotEmpty()
            ? $experiences->map(function ($exp) {
                return "- {$exp->position} в {$exp->organization} ({$exp->period_start} – " . ($exp->present ? 'настоящее время' : $exp->period_end) . "): {$exp->description}";
            })->implode("\n")
            : 'Нет опыта работы';

        $educationText = $educations->isNotEmpty()
            ? $educations->map(function ($edu) {
                return "- {$edu->institution}, {$edu->specialization} ({$edu->period_start} – " . ($edu->present ? 'настоящее время' : $edu->period_end) . ")";
            })->implode("\n")
            : 'Нет образования';

        return "
        Напиши сопроводительное письмо на русском языке для вакансии \"{$vacancyData['job_title']}\" в компании \"{$vacancyData['company_name']}\".
        Кандидат:
        Имя: {$fullName}
        Email: {$email}
        Телефон: {$phone}

        Опыт работы:
        {$experienceText}

        Образование:
        {$educationText}

        Требования к письму:
        - Формат: официальное деловое письмо
        - Адресат: Генеральный директор, {$vacancyData['company_name']}
        - Начало: 'Здравствуйте!' или 'Добрый день!'
        - Подпись: 'С уважением, [{$fullName}]'
        - Не использовать вымышленные данные
        - Подчеркнуть соответствие требованиям вакансии и мотивацию
        - Профессиональный, но дружелюбный тон
        - 4–5 абзацев
        - Завершить корректно, без обрывов

        Не используй шаблонные фразы вроде 'Уважаемый HR'.";
    }
}
