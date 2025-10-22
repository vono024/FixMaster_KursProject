<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Введіть поточний пароль',
            'password.required' => 'Введіть новий пароль',
            'password.min' => 'Пароль має містити мінімум 8 символів',
            'password.confirmed' => 'Паролі не співпадають',
        ];
    }
}
