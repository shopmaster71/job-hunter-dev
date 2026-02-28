<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantRequest extends FormRequest
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
            'patronymic' => 'nullable|string|max:255',
            'city_name' => 'required|string|max:255',
            'birth_date' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'citizenship' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'driving_licence' => 'string|nullable',
            'married' => 'string|nullable',
            'children' => 'string|nullable',
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
            'city_name.required' => 'Вы не выбрали город',
            'birth_date.required' => 'Вы не указали дату рождения',
            'gender.required' => 'Вы не указали пол',
            'citizenship.required' => 'Вы не указали гражданство',
            'education.required' => 'Вы не указали образование',
        ];
    }
}
