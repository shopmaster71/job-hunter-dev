<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'subheading' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|integer',
            'image' => $this->isMethod('put') ? 'nullable|image|max:5120' : 'required|image|max:5120',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    /**
     * Get messages for errors
     * @return string[]
     */
    public function messages()
    {
        return [
            'title.required' => 'Поле "Заголовок" не может быть пустым',
            'content.required' => 'Поле "Контент" не может быть пустым',
            'category_id.required' => 'Выберите категорию',
        ];
    }
}
