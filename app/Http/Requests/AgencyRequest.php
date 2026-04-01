<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'vk' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'title.required' => 'Вы не указали название aгентства',
            'email.required' => 'Вы не указали email',
            'phone.required' => 'Вы не указали телефон',
            'city_name.required' => 'Вы не выбрали город',
            'address.required' => 'Вы не указали адрес',
        ];
    }
}
