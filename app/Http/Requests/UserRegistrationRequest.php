<?php

namespace App\Http\Requests;

use AkostDev\YandexCaptcha\Rules\YandexCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'name' => 'nullable|string',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required', 'integer'],
            'smart-token' => ['required', new YandexCaptcha] // Валидация капчи
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Вы не указали email',
            'email.email' => 'Неверный формат email',
            'email.unique:users' => 'Пользователь с таким email уже зарегистрирован',
            'password.required' => 'Придумайте пароль',
            'password.min:8' => 'Минимальное количество символов в пароле - 8',
            'password.confirmed' => 'Вы не подтвердили пароль',
            'role.required' => 'Выберите роль',
            'smart-token.required' => 'Пожалуйста, пройдите проверку капчи.',
            'smart-token.yandex_captcha' => 'Проверка капчи не пройдена. Попробуйте ещё раз.'
        ];
    }
}
