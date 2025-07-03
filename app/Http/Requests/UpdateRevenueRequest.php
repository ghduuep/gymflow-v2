<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\RevenueCategory;

class UpdateRevenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $expenseId = $this->route('revenue')->id;

        return [
            'name' => ['sometimes|required|string|min:2|max:30', Rule::unique('revenues', 'name')->ignore($expenseId)],
            'description' => 'sometimes|nullable|string|max:50',
            'value' => 'sometimes|required|numeric',
            'category' => ['sometimes|required', Rule::enum(RevenueCategory::class)],
            'date' => 'sometimes|required|date',
        ];
    }
}
