<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Seller extends Model
{
    use SoftDeletes;
    protected $fillable =  [
        'name',
        'phone',
        'gender',
        'created_at',
        'updated_at',
    ];


    public function request_seller(){
        return $this->hasMany(RequestSeller::class);
    }

    public static function boot()
    {
         parent::boot();
         static::addGlobalScope('status',function (Builder $builder) {
            $builder->orderByDesc('id');
         });
    }


    public function getDeletedAtAttribute($value){
        return Jalalian::fromDateTime($value)->format("H:i:s Y/m/d");
    }

    public function scopeSearchName($query,$search_name){
        if (!empty($search_name)) {
            $buyers = $query->where('name', 'like', "%$search_name%");
        }
    }


    public function scopeSearchPhone($query,$search_phone){
        if (!empty($search_phone)) {
            $buyers = $query->where('phone', 'like', "%$search_phone%");
        }
    }


    public function scopeSearchInformation($query,$value){
      return  $query->where(function($query) use ($value){
            $query->where('name', 'like', "%$value%")
                  ->orWhere('phone', 'like', "%$value%");
            
        });
    }


    public function scopeSearchGender($query,$search_gender){
        if (!empty($search_gender)) {
            $buyers = $query->where('gender', "%$search_gender%");
        }
    }
}
