<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HrInformationRequest extends FormRequest
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
            'sector' => 'required|integer',
            'advantage' => 'nullable|string|max:255',
            'about' => 'required|string',
            'experience' => 'required|integer',
            'services' => 'nullable|string|max:255',
            'city_name' => 'required|string|max:255',
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'sector.integer' => 'Вы не указали отрасль',
            'about.required' => 'Вы не рассказали о себе',
            'experience.required' => 'Вы не указали стаж',
            //'services.required' => 'Вы не добавили услуги',
            'city_name.required' => 'Вы не указали город',
        ];
    }
}
