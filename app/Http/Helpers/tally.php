<?php

declare(strict_types=1);

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class Tally
{
    public static function cadr_info()
    {
        $data['count_buyers'] = DB::table('buyers')->count();
        $data['count_buyer_requests'] = DB::table('buyer_requests')->count();
        $data['count_sellers'] = DB::table('sellers')->count();
        $data['count_seller_requests'] = DB::table('request_sellers')->count();

        return $data;
    }


    public static function report_chart($report_type)
    {
        $date = Jalalian::now();
        $year = $date->getYear();
        $get_last_day_month = $date->getEndDayOfMonth();
        $month = (int)$date->format('m');
        $get_dayes_this_month = $date->getDaysOf($month);
        $data['dont_sell'] = [];
        $data['sell'] = [];
        $data['archive'] = [];
        if ($report_type === 'daily') {
            for ($day = 1; $day <= $get_dayes_this_month; $day++) {
                $day > 10 ? $day : $day = '0' . $day;
                $get_first_day_month = $date->getFirstDayOfMonth()->format("Y-$month-$day 00:00:00");
                $data['dont_sell'] = [
                    'lable' => 'daily',
                    'data' => DB::table('request_sellers')
                        ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->whereNull('building_buyers.id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->where('request_sellers.created_at', 'LIKE', "%$get_first_day_month%")
                        ->count(),
                ];
                $data['sell'] = [
                    'lable' => 'daily',
                    'data' => DB::table('request_sellers')
                        ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->whereNotNull('building_buyers.id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->where('request_sellers.created_at', 'LIKE', "%$get_first_day_month%")
                        ->count(),
                ];
                $data['archive'] = [
                    'lable' => 'daily',
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 1)
                        ->where('request_sellers.created_at', 'LIKE', "%$get_first_day_month%")
                        ->count(),
                ];
            }
        } else if ($report_type === 'weekly') {
            $start = $date->getFirstDayOfMonth();
            $end = $date->getEndDayOfMonth();
            $week = 1;
            while ($start <= $end) {
                $start_week = $start;
                $week_end = $start->addDays(6);
                $data['dont_sell'][] = [
                    'lable' => $week,
                    'data' => DB::table('request_sellers')
                        ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->whereNull('building_buyers.id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->whereBetween('request_sellers.created_at', [$start_week->format("Y-m-d 00:00:00"), $week_end->format("Y-m-d 23:59:59")])
                        ->count(),
                ];


                $data['sell'][] = [
                    'lable' => $week,
                    'data' => DB::table('request_sellers')
                        ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->whereNotNull('building_buyers.id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->whereBetween('request_sellers.created_at', [$start_week->format("Y-m-d 00:00:00"), $week_end->format("Y-m-d 23:59:59")])
                        ->count(),
                ];


                $data['archive'][] = [
                    'lable' => $week,
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 1)
                        ->whereBetween('request_sellers.created_at', [$start_week->format("Y-m-d 00:00:00"), $week_end->format("Y-m-d 23:59:59")])
                        ->count(),
                ];
                $start = $week_end->addDay();
                $week++;
            }
        } elseif ($report_type === 'monthly') {
            for ($month = 1; $month <= 12; $month++) {
                $month < 10 ? $month = '0' . $month : $month;

                // شروع ماه شمسی
                $start_jalali = $date->format("$year-$month-01 00:00:00");

                // تعداد روزهای ماه شمسی
                $day = (new Jalalian((int)$year, (int)$month, 01))->getMonthDays();

                // // پایان ماه شمسی = شروع + تعداد روزهای ماه - 1
                $end_jalali = $date->format("$year-$month-$day 23:59:59");
                // dd($start_jalali, $end_jalali);
                $data['dont_sell'][] = [
                    'lable' => $month,
                    'data' => DB::table('request_sellers')
                        ->leftJoin('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->whereNull('building_buyers.id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->whereBetween('request_sellers.created_at', [$start_jalali, $end_jalali])
                        ->count(),
                ];
                $data['sell'][] = [
                    'lable' => $month,
                    'data' => DB::table('request_sellers')
                        ->leftJoin('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->whereNotNull('building_buyers.id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->whereBetween('request_sellers.created_at', [$start_jalali, $end_jalali])
                        ->count(),
                ];
                $data['archive'][] = [
                    'lable' => $month,
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 1)
                        ->whereBetween('request_sellers.created_at', [$start_jalali, $end_jalali])
                        ->count(),
                ];
            }
        } elseif ($report_type === 'yearly') {
            $get_year_of_database = DB::table('request_sellers')->select('created_at')->pluck('created_at');

            $get_years = $get_year_of_database->map(function ($item) {
                return Jalalian::fromFormat('Y-m-d H:i:s', $item)->getYear();
            })->unique()->values();
            foreach ($get_years as $year) {
                $data['dont_sell'] = [
                    'lable' => $year,
                    'data' => DB::table('request_sellers')
                        ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->where('request_sellers.created_at', 'LIKE', "%$year%")
                        ->count(),
                ];
                $data['sell'] = [
                    'lable' => $year,
                    'data' => DB::table('request_sellers')
                        ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->where('request_sellers.created_at', 'LIKE', "%$year%")
                        ->count(),
                ];
                $data['archive'] = [
                    'lable' => $year,
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 1)
                        ->where('request_sellers.created_at', 'LIKE', "%$year%")
                        ->count(),
                ];
            }
        }

        return $data;
    }


    public static function report_import_export($import_export_type)
    {

        $date = Jalalian::now();
        $year = $date->getYear();
        $get_last_day_month = $date->getEndDayOfMonth();
        $month = (int)$date->format('m');
        $get_dayes_this_month = $date->getDaysOf($month);
        $data['dont_sell'] = [];
        $data['sell'] = [];
        $data['archive'] = [];
        if ($import_export_type === 'daily') {
            for ($day = 1; $day <= $get_dayes_this_month; $day++) {
                $day > 10 ? $day : $day = '0' . $day;
                $get_first_day_month = $date->getFirstDayOfMonth()->format("Y-$month-$day 00:00:00");
                $data['seller_request'] = [
                    'lable' => 'daily',
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->where('request_sellers.created_at', 'LIKE', "%$get_first_day_month%")
                        ->count(),
                ];
                $data['buyer_requests'] = [
                    'lable' => 'daily',
                    'data' => DB::table('buyer_requests')
                        ->where('buyer_requests.is_deleted', 0)
                        ->where('buyer_requests.created_at', 'LIKE', "%$get_first_day_month%")
                        ->count(),
                ];
            }
        } else if ($import_export_type === 'weekly') {
            $start = $date->getFirstDayOfMonth();
            $end = $date->getEndDayOfMonth();
            $week = 1;
            while ($start <= $end) {
                $start_week = $start;
                $week_end = $start->addDays(6);

                $data['seller_request'][] = [
                    'lable' => $week,
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->whereBetween('request_sellers.created_at', [$start_week->format("Y-m-d 00:00:00"), $week_end->format("Y-m-d 23:59:59")])
                        ->count(),
                ];


                $data['buyer_requests'][] = [
                    'lable' => $week,
                    'data' => DB::table('buyer_requests')
                        ->where('buyer_requests.is_deleted', 0)
                        ->whereBetween('buyer_requests.created_at', [$start_week->format("Y-m-d 00:00:00"), $week_end->format("Y-m-d 23:59:59")])
                        ->count(),
                ];
                $start = $week_end->addDay();
                $week++;
            }
        } elseif ($import_export_type === 'monthly') {
            for ($month = 1; $month <= 12; $month++) {
                $month < 10 ? $month = '0' . $month : $month;

                // شروع ماه شمسی
                $start_jalali = $date->format("$year-$month-01 00:00:00");

                // تعداد روزهای ماه شمسی
                $day = (new Jalalian((int)$year, (int)$month, 01))->getMonthDays();

                // // پایان ماه شمسی = شروع + تعداد روزهای ماه - 1
                $end_jalali = $date->format("$year-$month-$day 23:59:59");


                $data['seller_request'][] = [
                    'lable' => $month,
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->whereBetween('request_sellers.created_at', [$start_jalali, $end_jalali])
                        ->count(),
                ];
                $data['buyer_requests'][] = [
                    'lable' => $month,
                    'data' => DB::table('buyer_requests')
                        ->where('buyer_requests.is_deleted', 0)
                        ->whereBetween('buyer_requests.created_at', [$start_jalali, $end_jalali])
                        ->count(),
                ];
            }
        } elseif ($import_export_type === 'yearly') {
            $get_year_of_database = DB::table('request_sellers')->select('created_at')->pluck('created_at');

            $get_years = $get_year_of_database->map(function ($item) {
                return Jalalian::fromFormat('Y-m-d H:i:s', $item)->getYear();
            })->unique()->values();
            foreach ($get_years as $year) {
                $data['seller_request'] = [
                    'lable' => $year,
                    'data' => DB::table('request_sellers')
                        ->where('request_sellers.is_deleted', 0)
                        ->where('request_sellers.is_archive', 0)
                        ->where('request_sellers.created_at', 'LIKE', "%$year%")
                        ->count(),
                ];
                $data['buyer_requests'] = [
                    'lable' => $year,
                    'data' => DB::table('buyer_requests')
                        ->where('buyer_requests.is_deleted', 0)
                        ->where('buyer_requests.created_at', 'LIKE', "%$year%")
                        ->count(),
                ];
            }
        }

        return $data;
    }


    public static function report_total_revenue(){
      $count_request_sellers =  DB::table('request_sellers')->count();
      $count_buyer_requests = DB::table('buyer_requests')->count();
      $data['all_requests_count'] = number_format($count_request_sellers + $count_buyer_requests);

      $data['all_buyers_count'] = number_format(DB::table('buyers')->count());

      $sell_buildings_count = DB::table('request_sellers')
      ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
      ->whereNotNull('building_buyers.id')
      ->where('request_sellers.is_deleted', 0)
      ->where('request_sellers.is_archive', 0)
      ->count();

      $dont_sell_buildings_count = DB::table('request_sellers')
      ->join('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
      ->whereNull('building_buyers.id')
      ->where('request_sellers.is_deleted', 0)
      ->where('request_sellers.is_archive', 0)
      ->count();
    //   dd(3*100);

      $data['sell_buildings_count'] = number_format($sell_buildings_count);

      $data['rent_houses_count'] = number_format(DB::table('request_sellers')->where('request_sellers.request_type', 'ejareh')->count());
      $data['earth_lands_count'] = number_format(DB::table('request_sellers')->whereIn('request_sellers.reoperty_type', ['earth_maskoni','earth_tejari'])->count());
      $data['residential_lands_count'] = number_format(DB::table('request_sellers')->where('request_sellers.reoperty_type', 'maskoni')->count());
      $data['archive_buildings_count'] = number_format(DB::table('request_sellers')->where('request_sellers.is_archive', 1)->count());

      return $data; 
    }
}
