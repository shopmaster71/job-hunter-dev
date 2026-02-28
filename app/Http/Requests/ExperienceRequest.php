<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'position' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'period_start' => 'required|string|max:10',
            'period_end' => 'required_without_all:present',
            'present' => 'required_without_all:period_end',
            'description' => 'required|string'
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'position.required' => 'Вы не указали должность',
            'city.required' => 'Вы не указали город',
            'organization.required' => 'Вы не указали организацию',
            'period_start.required' => 'Вы не указали начало работы',
            'period_end.required_without_all' => 'Укажите дату увольнения или отметьте пункт "По настоящее время"',
            'present.required_without_all' => 'Отметьте пункт "По настоящее время" или укажите дату увольнения',
            'description.required' => 'Вы не указали обязанности и достижения'
        ];
    }
}
