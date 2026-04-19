<?php

namespace App\Http\Requests\Buyers;

use Illuminate\Foundation\Http\FormRequest;

class BuyerStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:buyers|max:11',
            'gender' => 'required|in:male,female',
        ];
    }
}
