<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'client';
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'device_type' => 'required|string|max:500',
            'scheduled_date' => 'nullable|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Назва заявки обов\'язкова',
            'title.max' => 'Назва не може бути довшою за 255 символів',
            'description.required' => 'Опис проблеми обов\'язковий',
            'description.max' => 'Опис не може бути довшим за 2000 символів',
            'device_type.required' => 'Тип пристрою обов\'язковий',
            'device_type.max' => 'Тип пристрою не може бути довшим за 500 символів',
            'scheduled_date.date' => 'Некоректна дата',
            'scheduled_date.after' => 'Дата має бути в майбутньому',
        ];
    }
}
