<?php

namespace App\Http\Controllers\CronJob;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class ArchiveRequestSellerController extends Controller
{
    public function archive_request_sell() {
        $today = Jalalian::now()->format("Y-m-d H:i:s");
        DB::table('request_sellers')->where('archive_date', $today)->update([
            'is_archive'=>1,
        ]);

        return response()->json([
            'statsu'=>200,
            'message'=>'اطلاعات ثبت شد'
        ]);

    }
}
