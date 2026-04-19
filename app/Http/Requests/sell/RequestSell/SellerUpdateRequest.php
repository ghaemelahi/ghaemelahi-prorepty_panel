<?php

namespace App\Http\Requests\sell\RequestSell;

use Illuminate\Foundation\Http\FormRequest;

class SellerUpdateRequest extends FormRequest
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
            'seller_id' => 'required|exists:sellers,id',
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'gender' => 'required|in:male,female',
        ];
    }
}
