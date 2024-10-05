<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use App\Models\Topic;

class StorePostRequest extends FormRequest
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
            'image.*' => 'image|mimes:jpg,jpeg,gif,png|max:5120',
            'content' => 'required|string|max:5000',
            'topic' => 'required|string|max:255|in:' . implode(',', Topic::pluck('name')->toArray()),
            'author' => 'uuid'
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'Текст поста обязателен',
            'content.string' => 'Текст поста должен быть строкового типа',
            'content.max' => 'Текст поста должен быть менее 5000 символов',
            'topic.required' => 'Тема поста обязательна',
            'topic.string' => 'Тема поста должена быть строкового типа',
            'topic.max' => 'Тема поста должена быть менее 255 символов',
            'topic.in' => 'Данная тема не существует',
            'image.*.image' => 'Файлы должены быть картиной',
            'image.*.mimes' => 'Поддерживаемые типы файлов: png, gif, jpeg, jpg',
            'image.*.max' => 'Максимальный размер файла 5МБ',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'message' => 'Ошибка валидации',
            'errors' => $validator->errors(),
        ], 422));
    }
}
