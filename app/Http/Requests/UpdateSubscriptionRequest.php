<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\SubscriptionStatus;

class UpdateSubscriptionRequest extends FormRequest
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
            'students_ids' => 'sometimes|array',
            'students_ids.*' => 'required|exists:students, id',
            'status' => ['sometimes', Rule::enum(SubscriptionStatus::class)],
            'start_date' => 'sometimes|date|',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
        ];
    }
}
