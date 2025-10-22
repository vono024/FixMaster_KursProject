<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMasterProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'master';
    }

    public function rules(): array
    {
        return [
            'specialization' => 'required|string|max:255',
            'bio' => 'required|string|min:50|max:1000',
            'hourly_rate' => 'required|numeric|min:50|max:999999.99',
            'phone' => 'required|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'specialization.required' => 'Спеціалізація обов\'язкова',
            'bio.required' => 'Про себе обов\'язкове',
            'bio.min' => 'Опис має містити мінімум 50 символів',
            'hourly_rate.required' => 'Вкажіть вашу ставку',
            'hourly_rate.min' => 'Мінімальна ставка 50 грн/год',
            'phone.required' => 'Телефон обов\'язковий',
        ];
    }
}
