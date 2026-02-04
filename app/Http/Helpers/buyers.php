<?php
declare(strict_types=1);

use Illuminate\Support\Facades\DB;

function buyer_info($buyer_id) {
    $buyer_info = DB::table('buyers')->whereId($buyer_id)->first();
    return $buyer_info;
}