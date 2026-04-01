<?php

namespace App\Http\Requests;

use AkostDev\YandexCaptcha\Rules\YandexCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class AgencyMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'theme' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:255',
            'status' => 'integer',
            'smart-token' => ['required', new YandexCaptcha] // Валидация капчи
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'email.required' => 'Вы не указали Email',
            'message.required' => 'Вы не написали сообщение',
            'theme.required' => 'Вы не указали тему сообщения',
        ];
    }
}
