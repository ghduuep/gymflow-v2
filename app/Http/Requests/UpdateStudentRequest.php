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
                'size:11',
            ],
            'phone' => 'sometimes|nullable|string|regex:/^\d{10,11}$/',
            'email' => 'sometimes|nullable|email|max:255',
            'address.street' => 'sometimes|nullable|string|max:255',
            'address.number' => 'sometimes|nullable|string|max:10',
            'address.neighborhood' => 'sometimes|nullable|string|max:255',
            'address.complement' => 'sometimes|nullable|string',
            'address.city' => 'sometimes|nullable|string|max:255',
            'address.state' => 'sometimes|nullable|string|max:2',
            'address.zip_code' => 'sometimes|nullable|string',
            'birth_date' => 'sometimes|nullable|date|before:today',
            'active' => 'sometimes|nullable|boolean',
        ];
    }
}
