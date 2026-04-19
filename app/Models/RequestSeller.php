<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestSeller extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'seller_id',
        'reoperty_type',
        'request_type',
        'dimensions_building',
        'meterage_building',
        'year_manufacture',
        'document_type',
        'monthly_amount',
        'down_payment',
        'price',
        'options',
        'number_bedrooms',
        'address',
        'street_name',
        'water',
        'electric',
        'gas',
        'telephone',
        'description',
        'status',
        'is_archive',
        'archive_date',
        'is_deleted',
        'created_at',
        'updated_at',
        'is_deleted',
    ];

    public function seller() {
        return $this->belongsTo(Seller::class);
    }
}
