<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'reoperty_type'=>$this->reoperty_type,
            'monthly_amount'=>$this->monthly_amount,
            'down_payment'=>$this->down_payment,
            'price'=>$this->price,
            'request_type'=>$this->request_type,
            'bedrooms'=>$this->bedrooms,
            'description'=>$this->description,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
        ];
    }
}
