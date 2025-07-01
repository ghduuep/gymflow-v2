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
            'cpf' => 'required|string|size:11',
            'phone' => 'required|string|regex:/^\d{10,11}$/',
            'email' => 'nullable|email|max:255|unique:students,email',
            'address' => 'nullable|array|',
            'address.street' => 'nullable|string|max:255',
            'address.number' => 'nullable|string|max:10',
            'address.neighborhood' => 'nullable|string|max:255',
            'address.complement' => 'nullable|string',
            'address.city' => 'nullable|string|max:255',
            'address.state' => 'nullable|string|size:2',
            'address.zipcode' => ['nullable|string|regex:^\d{5}-\d{3}$'],
            'birth_date' => 'nullable|date|before:today',
            'active' => 'nullable|boolean',
        ];
    }
}
