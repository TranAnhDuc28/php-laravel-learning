<?php

namespace App\Http\Requests;

use App\Enums\UserStatus;
use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends FormRequest
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
        $isUpdate = $this->method() === 'PUT' || $this->method() === 'PATCH';

        $rules = [
            'department_id' => ['nullable', 'numeric', 'integer', Rule::exists(Department::class, 'id')],
            'job_position' => ['nullable', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'join_date' => ['nullable', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
        ];

        if (!$isUpdate) {
            $rules['email'] = ['required', 'email', Rule::unique(User::class)];
            $rules['password'] = ['required', 'string', 'max:30', Password::min(8)];
        } else {
            $id = $this->route('id');
            $rules['email'] = ['required', 'email', Rule::unique(User::class)->ignore($id, 'id')];
            $rules['status'] = ['required', Rule::enum(UserStatus::class)];
        }

        return $rules;
    }
}
