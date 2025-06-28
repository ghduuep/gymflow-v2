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
                'required',
                'string',
                Rule::unique('plans', 'name')->ignore($planId),
                'min:2',
                'max:30'
            ],
            'description' => 'sometimes|required|string|max:50',
            'price' => 'sometimes|required|decimal',
            'duration_months' => 'sometimes|required|integer|min:1',
            'active' => 'sometimes|required|boolean',           
        ];
    }
}
