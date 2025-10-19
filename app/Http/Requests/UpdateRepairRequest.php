<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $rules = [
            'problem_description' => 'sometimes|string|min:10',
            'priority' => 'sometimes|in:low,medium,high',
        ];

        if (auth()->user()->role === 'master' || auth()->user()->role === 'admin') {
            $rules['status'] = 'sometimes|in:new,in_progress,completed,closed';
            $rules['estimated_cost'] = 'nullable|numeric|min:0';
            $rules['final_cost'] = 'nullable|numeric|min:0';
        }

        return $rules;
    }
}
