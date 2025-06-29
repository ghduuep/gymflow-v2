<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        $taskId = $this->route('task')->id;

        return [
            'name' => ['sometimes','required','string','min:2','max:30', Rule::unique('tasks', 'name')->ignore($taskId)],
            'description' => 'sometimes|required|string|max:50',
            'completed' => 'sometimes|required|boolean',
            'priority' => ['sometimes|required', Rule::enum(TaskPriority::class)],
            'active' => 'sometimes|required|boolean',
        ];
    }
}
