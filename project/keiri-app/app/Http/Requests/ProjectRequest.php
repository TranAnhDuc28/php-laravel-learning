<?php

namespace App\Http\Requests;

use App\Enums\ProjectPriority;
use App\Enums\ProjectStatus;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'project_code' => ['required', 'string', 'max:255'],
            'project_name' => ['required', 'string', 'max:255'],
            'project_start_date' => ['required', 'date'],
            'project_end_date' => ['required', 'date', Rule::date()->after('project_start_date')],
            'note' => ['nullable', 'string', 'max:1000'],
            'phase' => ['nullable', 'numeric', 'integer'],
            'priority' => ['nullable', Rule::enum(ProjectPriority::class)],
            'status' => ['nullable', Rule::enum(ProjectStatus::class)],
            'team_members' => ['nullable', 'array'],
            'team_members.*' => ['numeric', 'integer', Rule::exists(User::class, 'id')],
        ];

        return $rules;
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'team_members.*.numeric' => 'The value ":input" field must be a number.',
            'team_members.*.integer' => 'The value ":input" for team member is not a valid number.',
            'team_members.*.exists' => 'The team member with ID :input does not exist.',
        ];
    }
}
