<?php
declare(strict_types= 1);

use Illuminate\Support\Facades\DB;

function found_seller(string $sell_phone,string $sell_name,string $gender)
{
    $check_has_seller = DB::table("sellers")->where('phone',$sell_phone)->first();

    
    $sell_id = null;

    if ($check_has_seller) {
        $sell_id = $check_has_seller->id;
    }else{
       $sell_id = DB::table("sellers")->insertGetId([
            "phone"=> $sell_phone,
            "name"=> $sell_name,
            "gender"=> $gender,
        ]);
    }
    return $sell_id;
}