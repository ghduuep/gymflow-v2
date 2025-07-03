<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\RevenueCategory;
use Illuminate\Validation\Rule;

class StoreRevenueRequest extends FormRequest
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
        return [
            'name' => 'required|string|unique:revenues, name|min:2|max:30',
            'description' => 'nullable|string|max:50',
            'value' => 'required|numeric',
            'category' => ['required', Rule::enum(RevenueCategory::class)],
            'date' => 'required|date',
        ];
    }
}
