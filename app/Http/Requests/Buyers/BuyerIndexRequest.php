<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class BuyerIndexRequest extends FormRequest
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
            'search_name' => 'nullable|string|max:255',
            'search_phone' => 'nullable|string|max:11|unique:buyers,phone',
            'search_gender' => 'nullable|in:male,female',
        ];
    }
}
