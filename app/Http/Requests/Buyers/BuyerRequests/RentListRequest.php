<?php

namespace App\Http\Requests\Buyers\BuyerRequests;

use Illuminate\Foundation\Http\FormRequest;

class RentListRequest extends FormRequest
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
            'search_reoperty_type'=>'nullable|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'search_request_type'=>'nullable|in:ejareh',
            'search_price'=>'nullable|in:ejareh',
            'search_bedrooms'=>'nullable|in:ejareh',
            'search_info_buyer'=>'nullable',
        ];
    }
}
