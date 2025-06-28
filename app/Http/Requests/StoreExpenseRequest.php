<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\ExpenseCategory;

class StoreExpenseRequest extends FormRequest
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
        return [
            'name' => 'required|string|unique:expenses, name|min:2|max:30',
            'description' => 'nullable|string|max:50',
            'category' => ['required', Rule::enum(ExpenseCategory::class)],
            'value' => 'required|decimal',
            'paid' => 'required|boolean',
            'date' => 'required|date|'
        ];
    }
}
