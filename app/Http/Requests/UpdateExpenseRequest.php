<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\ExpenseCategory;

class UpdateExpenseRequest extends FormRequest
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
        $expenseId = $this->route('expense')->id;

        return [
            'name' => ['sometimes|string|min:2|max:30', Rule::unique('expenses', 'name')->ignore($expenseId)],
            'description' => 'sometimes|nullable|string|max:50',
            'category' => ['sometimes', Rule::enum(ExpenseCategory::class)],
            'value' => 'sometimes|numeric',
            'paid' => 'sometimes|boolean',
            'date' => 'sometimes|date|'
        ];
    }
}
