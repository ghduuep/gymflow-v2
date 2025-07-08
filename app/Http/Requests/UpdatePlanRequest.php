<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlanRequest extends FormRequest
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
        $planId = $this->route('plan')->id;

        return [
            'name' => [
                'sometimes',
                'string',
                Rule::unique('plans', 'name')->ignore($planId),
                'min:2',
                'max:30'
            ],
            'description' => 'sometimes|string|max:50',
            'price' => 'sometimes|numeric',
            'duration_months' => 'sometimes|integer|min:1',
            'active' => 'sometimes|boolean',           
        ];
    }
}
