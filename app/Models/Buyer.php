<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'phone ',
        'is_deleted',
        'created_at',
        'updated_at',
        'delete_at',
    ];

    public function buyer_requests() {
        return $this->hasMany(BuyerRequest::class);
    }
}
