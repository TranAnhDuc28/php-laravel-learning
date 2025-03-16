<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $id = $this->route('product')->id;
;
        return [
            'category' => ['required'],
            'name' => ['required', 'string', 'max:255', Rule::unique(Product::class)->ignore($id)],
            'price' => ['required', 'numeric', 'min:1'],
            'description' => ['nullable'],
            'image_path' => ['nullable'],
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'numeric', 'integer', 'min:1'],
            'galleries' => ['nullable', 'array'],
            'galleries.*' => ['required', 'image'],
        ];
    }
}
