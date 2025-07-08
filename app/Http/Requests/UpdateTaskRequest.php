<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\TaskPriority;

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
            'name' => ['sometimes','string','min:2','max:30', Rule::unique('tasks', 'name')->ignore($taskId)],
            'description' => 'sometimes|string|max:50',
            'completed' => 'sometimes|boolean',
            'priority' => ['sometimes', Rule::enum(TaskPriority::class)],
            'active' => 'sometimes|boolean',
        ];
    }
}
