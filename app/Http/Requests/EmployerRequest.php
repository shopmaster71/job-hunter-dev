<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployerRequest extends FormRequest
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
            'sector' => 'required|integer',
            'city_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'about' => 'required|string',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'title.required' => 'Вы не указали название',
            'sector.required' => 'Вы не указали отрасль',
            'city_name.required' => 'Вы не выбрали город',
            'address.required' => 'Вы не указали адрес',
            'about.required' => 'Вы не рассказали о компании',
        ];
    }
}
