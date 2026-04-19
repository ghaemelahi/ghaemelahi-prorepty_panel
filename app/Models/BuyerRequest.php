<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BuyerRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'buyer_id',
        'reoperty_type',
        'price',
        'request_type',
        'bedrooms',
        'description',
        'monthly_amount',
        'down_payment',
        'status',
        'is_deleted',
        'created_at',
        'updated_at',
        'delete_at',
    ];


    public function buyer() {
        return $this->belongsTo(Buyer::class);
        
    }

    public static function boot()
    {
         parent::boot();
         static::addGlobalScope('status',function (Builder $builder) {
            $builder->orderByDesc('id');
         });
    }


    // public function getPersianReopertyTypeAttribute() {
    //     switch($this->reoperty_type){
    //         case 'tejari': return 'تجاری';
    //         case 'maskoni': return 'مسکونی';
    //         case 'earth_maskoni': return 'زمین مسکونی';
    //         case 'earth_tejari': return 'زمین تجاری';
    //         default: return 'هیچی';
    //     }
    // }

    public function scopeSearchReopertyType($query,$search_reoperty_type) {
        if ($search_reoperty_type != null) {
            return $query->where('reoperty_type', $search_reoperty_type);
        }
    }

    public function scopeSearchRequestType($query,$search_request_type) {
        if ($search_request_type != null) {
            return $query->where('reoperty_type', $search_request_type);
        }
    }

    public function scopeSearchMonthlyAmount($query,$monthly_amount) {
        if ($monthly_amount != null) {
            return $query->whereMonthly_amount($monthly_amount);
        }
    }

    public function scopeSearchDownPayment($query,$search_down_payment) {
        if ($search_down_payment != null) {
            return $query->whereDown_payment($search_down_payment);
        }
    }

    public function scopeSearchPrice($query,$search_price) {
        if ($search_price != null) {
            return $query->where('price', $search_price);
        }
    }

    public function scopeSearchBedrooms($query,$search_bedrooms) {
        if ($search_bedrooms != null) {
            return $query->where('bedrooms', $search_bedrooms);
        }
    }
}
