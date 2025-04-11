<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', Rule::unique(Post::class), 'max:255'],
            'body' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is required (test).',
        ];
    }

    public function attributes() {
        return [
            'title' => 'Title (test)',
        ];
    }
}
