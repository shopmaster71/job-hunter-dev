<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class EmployerVacancyRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'position' => 'required|string|max:255',
            'employment_type' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer|gte:salary_min',
            'contractual' => 'required|boolean',
            'experience' => 'required|string|max:255',
            'format' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'charge' => 'required|string',
            'requirement' => 'nullable|string',
            'conditions' => 'nullable|string',
            'additional' => 'nullable|string',
            'status' => 'nullable|integer',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $salaryMin = $this->input('salary_min');
            $contractualRaw = $this->input('contractual');
            $contractual = filter_var($contractualRaw, FILTER_VALIDATE_BOOLEAN);
            if (is_null($salaryMin) && $contractual === false) {
                $validator->errors()->add(
                    'salary_min',
                    'Укажите минимальную зарплату или отметьте "По договорённости".'
                );
            }
            if (!is_null($salaryMin) && $contractual === true) {
                $validator->errors()->add(
                    'contractual',
                    'Нельзя одновременно указывать зарплату и выбрать "По договорённости".'
                );
            }
        });
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'position.required' => 'Вы не указали должность',
            'city_name.required' => 'Вы не указали город',
            'organization.required' => 'Вы не указали организацию',
            'employment_type.required' => 'Вы не указали вид занятости',
            'schedule.required' => 'Вы не указали график работы',
            'experience.required' => 'Вы не указали необходимый опыт работы',
            'format.required' => 'Вы не указали формат работы',
            'address.required' => 'Вы не указали адрес работы',
            'charge.required' => 'Вы не указали обязанности по работе',
        ];
    }
}
