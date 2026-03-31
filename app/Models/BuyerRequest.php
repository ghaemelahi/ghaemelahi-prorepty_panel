<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerRequest extends Model
{
    protected $fillable = [
        'buyer_id',
        'reoperty_type',
        'price',
        'request_type',
        'bedrooms',
        'description',
        'status',
        'is_deleted',
        'created_at',
        'updated_at',
        'delete_at',
    ];


    public function buyer() {
        return $this->belongsTo(Buyer::class);
        
    }
}
