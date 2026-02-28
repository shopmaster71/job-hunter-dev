<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            'institution' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'faculty' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'period_start' => 'required|string|max:10',
            'period_end' => 'required_without_all:present',
            'present' => 'required_without_all:period_end',
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'institution.required' => 'Вы не указали учебное заведение',
            'city.required' => 'Вы не указали город',
            'period_start.required' => 'Вы не указали начало обучения',
            'period_end.required_without_all' => 'Укажите дату окончания обучения или отметьте пункт "По настоящее время"',
            'present.required_without_all' => 'Отметьте пункт "По настоящее время" или укажите дату окончания обучения',
        ];
    }
}
