<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $studentId = $this->route('student')->id;        

        return [
            'name' => 'sometimes|required|string|min:2|max:30',
            'cpf' => [
                'sometimes',
                'nullable',
                'required',
                'string',
                Rule::unique('students', 'cpf')->ignore($studentId),
                'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
            ],
            'phone' => 'sometimes|nullable|string|regex:/^\d{10,11}$/',
            'email' => 'sometimes|nullable|email|max:255',
            'address' => 'sometimes|nullable|string|max:255',
            'birth_date' => 'sometimes|nullable|date|before:today',
            'active' => 'sometimes|nullable|boolean',
        ];
    }
}
