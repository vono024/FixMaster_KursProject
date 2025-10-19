<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'client';
    }

    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'rating.required' => 'Оберіть оцінку',
            'rating.min' => 'Мінімальна оцінка 1',
            'rating.max' => 'Максимальна оцінка 5',
            'comment.required' => 'Напишіть коментар',
            'comment.min' => 'Коментар має бути не менше 10 символів',
            'comment.max' => 'Коментар занадто довгий',
        ];
    }
}
