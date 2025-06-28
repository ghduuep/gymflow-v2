<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:30',
            'cpf' => 'required|string|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
            'phone' => 'required|string|regex:/^\d{10,11}$/',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date|before:today',
            'active' => 'nullable|boolean',
        ];
    }
}
