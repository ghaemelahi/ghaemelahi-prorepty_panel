<?php

namespace App\Http\Requests\Buyers\BuyerRequests;

use Illuminate\Foundation\Http\FormRequest;

class BuyerRequestStoreRequest extends FormRequest
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
            'buyer_id' => 'required|exists:buyers,id',
            'buyer_phone' => 'required|exists:buyers,phone',
            'buyer_name' => 'required',
            'reoperty_type' => 'required|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'request_type' => 'required|in:buy,ejareh',
            'price' => 'nullable',
            'down_payment' => 'nullable',
            'monthly_amount' => 'nullable',
            'bedrooms' => 'required',
            'description' => 'nullable|string',
        ];
    }
}
