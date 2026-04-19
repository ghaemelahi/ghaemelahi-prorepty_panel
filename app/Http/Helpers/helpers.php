<?php
declare(strict_types=1);
namespace App\Http\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class LogService
{

    public static function saveLog(string $report, $description = null): void
    {
        // تنظیم اطلاعات عمومی
        if (Auth::check()) {
            $user    = Auth::user()->name;
            $user_id = Auth::user()->id;
        } else {
            $user    = "کرون جاب";
            $user_id = null;
        }
        $date = Jalalian::now()->format('Y-m-d H:i:s');
        $time = Jalalian::now()->format('H:i:s');

        // ذخیره گزارش در دیتابیس
        DB::table('reports')->insert([
            'user_name'   => $user,
            'user_id'     => $user_id,
            'report'      => $report,
            'description' => $description,
            'date'        => $date,
            'time'        => $time,
        ]);
    }
}



//MARK:-> START CONVERT ENGLISH NUMBERS TO PERSIAN NUMBERS
function persian_number($number)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    return str_replace($english, $persian, $number);
}
//MARK:-> END CONVERT ENGLISH NUMBERS TO PERSIAN NUMBERS


//MARK:-> STATR CONVERT PERSIAN NUMBERS TO ENGLISH NUMBERS
function english_number($number)
{
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return str_replace($persian, $english, $number);
}
//MARK:-> END CONVERT PERSIAN NUMBERS TO ENGLISH NUMBERS