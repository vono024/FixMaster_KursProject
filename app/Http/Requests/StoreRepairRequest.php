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
            'device_type' => 'required|string|max:255',
            'device_brand' => 'required|string|max:255',
            'device_model' => 'nullable|string|max:255',
            'problem_description' => 'required|string|min:10',
            'priority' => 'nullable|in:low,medium,high',
        ];
    }

    public function messages(): array
    {
        return [
            'device_type.required' => 'Вкажіть тип пристрою',
            'device_brand.required' => 'Вкажіть бренд пристрою',
            'problem_description.required' => 'Опишіть проблему',
            'problem_description.min' => 'Опис має бути не менше 10 символів',
        ];
    }
}
