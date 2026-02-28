<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantContactRequest extends FormRequest
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
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'vk' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'vk_check' => 'string|nullable',
            'telegram_check' => 'string|nullable'
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'phone.required' => 'Вы не указали телефон',
            'email.required' => 'Вы не указали email'
        ];
    }
}
