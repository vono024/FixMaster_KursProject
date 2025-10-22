<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'specialization' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'hourly_rate' => 'nullable|numeric|min:0|max:999999.99',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ім\'я обов\'язкове',
            'email.required' => 'Email обов\'язковий',
            'email.email' => 'Некоректний email',
            'email.unique' => 'Цей email вже використовується',
            'avatar.image' => 'Файл має бути зображенням',
            'avatar.mimes' => 'Дозволені формати: jpeg, png, jpg',
            'avatar.max' => 'Максимальний розмір файлу 2MB',
            'hourly_rate.numeric' => 'Ставка має бути числом',
            'hourly_rate.min' => 'Мінімальна ставка 0',
        ];
    }
}
