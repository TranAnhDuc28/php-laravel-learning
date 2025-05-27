<?php

namespace App\Http\Requests;

use App\Models\ProjectAssignmentLog;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class ProjectAssignLogRequest extends FormRequest
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
            'logs' => ['required', 'array'],
            'logs.*.id' => ['required', 'numeric', 'integer', Rule::exists(ProjectAssignmentLog::class, 'id')],
            'logs.*.project_join_date' => ['required', 'date',],
            'logs.*.project_exit_date' => ['nullable', 'date', Rule::date()->after('logs.*.project_join_date'),],
            'logs.*.effort_percentage' => ['required', 'numeric', 'integer', 'between:0,100',],
            'logs.*.worked_days' => ['required', 'numeric', 'integer', 'min:0',],
        ];

        return $rules;
    }

    /**
     * Transform data after validation.
     *
     * @param $key
     * @param $default
     * @return mixed
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        if (isset($validated['logs'])) {
            foreach ($validated['logs'] as $logId => &$log) {
                $log['project_join_date'] = Carbon::parse($log['project_join_date'])->format('Y-m-d');
                $log['project_exit_date'] = !empty($log['project_exit_date'])
                    ? Carbon::parse($log['project_exit_date'])->format('Y-m-d')
                    : null;
            }
        }

        return $validated;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'logs.*.id.numeric' => 'The value ":input" field ID must be a number.',
            'logs.*.id.integer' => 'The value ":input" for log member ID is not a valid number.',
            'logs.*.id.exists' => 'The log with ID :input does not exist.',
            'logs.*.id.required' => 'The log field ID is required.',
        ];
    }
}
