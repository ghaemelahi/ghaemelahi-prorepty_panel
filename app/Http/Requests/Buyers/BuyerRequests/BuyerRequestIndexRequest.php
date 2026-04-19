<?php

namespace App\Http\Requests\Buyers\BuyerRequests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerRequestIndexRequest extends FormRequest
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
            // 'buyer_id' => 'required|exists:buyers,id',
            'search_reoperty_type' => 'nullable',
            'search_request_type' => 'nullable|in:buy,ejareh',
            'search_price' => 'nullable',
            'search_bedrooms' => 'nullable',
        ];
    }
}
