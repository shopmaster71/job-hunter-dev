<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.required' => 'Вы не указали имя',
            'surname.required' => 'Вы не указали фамилию',
        ];
    }
}
