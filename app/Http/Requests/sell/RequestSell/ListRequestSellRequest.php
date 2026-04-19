<?php

namespace App\Http\Requests\sell\RequestSell;

use Illuminate\Foundation\Http\FormRequest;

class ListRequestSellRequest extends FormRequest
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
            'request_reoperty_type' => 'nullable|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'search_request_type' => 'nullable|in:sell,ejareh',
            'request_price' => 'nullable|string',
            'request_address' => 'nullable|string',
            'search_info_seller' => 'nullable',
        ];
    }
}
