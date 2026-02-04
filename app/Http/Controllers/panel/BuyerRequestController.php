<?php

declare(strict_types=1);

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LogService;
use Morilog\Jalali\Jalalian;

class BuyerRequestController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index(Request $request, $buyer_id)
    {
        // dd($request->all());
        $data = $request->all();
        $data['buyer_id'] = $buyer_id;

        $validate = Validator::make($data, [
            'buyer_id' => 'required|exists:buyers,id',
            'search_reoperty_type' => 'nullable',
            'search_request_type' => 'nullable|in:sell,ejareh',
            'search_price' => 'nullable',
            'search_bedrooms' => 'nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_buyer');
        }

        $search_reoperty_type = $request->search_reoperty_type;
        $search_request_type = $request->search_request_type;
        $search_price = $request->search_price != null ? str_replace(',', '', $request->search_price) : null;
        $search_bedrooms = $request->search_bedrooms;

        $data['buyer_info'] = DB::table('buyers')->whereId($buyer_id)->first();
        $data['buyer_requests'] = DB::table('buyer_requests')->where('is_deleted', 0)->where('buyer_id', $buyer_id);
        if ($search_reoperty_type != null) {
            $data['buyer_requests'] = $data['buyer_requests']->where('reoperty_type', $search_reoperty_type);
        }
        if ($search_request_type != null) {
            $data['buyer_requests'] = $data['buyer_requests']->where('request_type', $search_request_type);
        }
        if ($search_price != null) {
            $data['buyer_requests'] = $data['buyer_requests']->where('price', $search_price);
        }
        if ($search_bedrooms != null) {
            $data['buyer_requests'] = $data['buyer_requests']->where('bedrooms', $search_bedrooms);
        }
        $data['buyer_requests'] = $data['buyer_requests']->paginate(50)->appends($request->query());

        return view("pages.buyers.buyer_request.list", compact('data', 'search_reoperty_type', 'search_request_type', 'search_price', 'search_bedrooms'));
    }

    public function proposal_building_list(Request $request, $buyer_id)
    {
        $validate = Validator::make(['buyer_id' => $buyer_id], [
            'buyer_id' => 'required|exists:buyers,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_buyer');
        }
        $data['buyer_info'] = DB::table('buyers')->whereId($buyer_id)->first();

        $data['buyer_requests'] = DB::table('buyer_requests')
            ->where('is_deleted', 0)
            ->where('buyer_id', $buyer_id)
            ->get();


        $offer_sell_buildings = null;
        foreach ($data['buyer_requests'] as $item) {
            $offer_sell_buildings = DB::table('request_sellers')
                ->join('sellers', 'request_sellers.seller_id', 'sellers.id')
                ->join('images_requests_seller', 'request_sellers.id', 'images_requests_seller.request_seller_id')
                ->leftJoin('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
                ->select([
                    'request_sellers.*',
                    'images_requests_seller.path',
                    'sellers.name as seller_name',
                    'sellers.phone as seller_phone',
                ])
                ->whereBetween('request_sellers.price', [0, $item->price])
                ->orWhere('request_sellers.reoperty_type', $item->reoperty_type)
                ->orWhere('request_sellers.request_type', $item->request_type)
                ->orWhere('request_sellers.number_bedrooms', $item->bedrooms)
                ->whereNull('building_buyers.buyer_id')
                ->where('request_sellers.is_archive', 0)
                ->where('request_sellers.is_deleted', 0)
                ->groupBy('request_sellers.id')
                ->paginate(50)->appends($request->query());
        }
        // dd($offer_sell_buildings);

        return view("pages.buyers.buyer_request.proposal_building", [
            'data' => $data,
            'offer_sell_buildings' => $offer_sell_buildings,
            'request_reoperty_type' => $request->request_reoperty_type,
            'search_request_type' => $request->search_request_type,
            'request_price' => $request->request_price,
            'request_address' => $request->request_address,
            'search_info_seller' => $request->search_info_seller,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
            'buyer_phone' => 'required|exists:buyers,phone',
            'buyer_name' => 'required',
            'reoperty_type' => 'required|in:tejari,maskoni,earth',
            'request_type' => 'required|in:sell,ejareh',
            'price' => 'required',
            'bedrooms' => 'required',
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_create_buyer_request');
        }

        $request->description = $request->description ?? "_";

        DB::table('buyer_requests')->insert([
            'buyer_id' => $request->buyer_id,
            'reoperty_type' => $request->reoperty_type,
            'price' => str_replace(",", "", $request->price),
            'request_type' => $request->request_type,
            'bedrooms' => $request->bedrooms,
            'description' => $request->description ?? "_",
            'created_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "create_buyer_request";
        $description = "یک درخواست جدید برای $request->buyer_name ثبت گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyer_requests', $request->buyer_id)->with('success_create_buyer_request', "درخواست ثبت گردید.");
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'request_id' => 'required|exists:buyer_requests,id',
            'buyer_id' => 'required|exists:buyers,id',
            'buyer_phone' => 'required|exists:buyers,phone',
            'buyer_name' => 'required',
            'reoperty_type' => 'required|in:tejari,maskoni,earth',
            'status' => 'required|in:doing,compelet',
            'request_type' => 'required|in:sell,ejareh',
            'price' => 'required',
            'bedrooms' => 'required',
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_update_buyer_request');
        }

        $request->description = $request->description ?? "_";

        DB::table('buyer_requests')->whereId($request->request_id)->update([
            'buyer_id' => $request->buyer_id,
            'reoperty_type' => $request->reoperty_type,
            'price' => str_replace(",", "", $request->price),
            'request_type' => $request->request_type,
            'bedrooms' => $request->bedrooms,
            'status' => $request->status,
            'description' => $request->description ?? "_",
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_buyer_request";
        $description = "درخواست $request->buyer_name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyer_requests', $request->buyer_id)->with('success_update_buyer_request', "درخواست بروزرسانی گردید.");
    }

    public function delete(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'request_id' => 'required|exists:buyer_requests,id',
            'buyer_id' => 'required|exists:buyers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_delete_buyer_request');
        }


        DB::table('buyer_requests')->whereId($request->request_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_buyer_request";
        $description = " درخواست $request->buyer_name حذف گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyer_requests', $request->buyer_id)->with('success_delete_buyer_request', "درخواست حذف گردید.");
    }









    public function delete_list(Request $request)
    {
        /* $validate = Validator::make(['buyer_id' => $buyer_id], [
            'buyer_id' => 'required|exists:buyers,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_buyer');
        }*/

        $data = DB::table('buyer_requests')
            ->join('buyers', 'buyer_requests.buyer_id', 'buyers.id')
            ->select([
                'buyer_requests.id',
                'buyer_requests.request_type',
                'buyer_requests.reoperty_type',
                'buyer_requests.delete_at',
                'buyers.id as buyer_id',
                'buyers.name',
                'buyers.phone',
            ])
            ->where('buyer_requests.is_deleted', 1)->paginate(50)->through(function ($item) {
                $item->request_type = match ($item->request_type) {
                    'sell' => 'فروش',
                    'ejareh' => 'اجاره',
                };

                $item->reoperty_type = match ($item->reoperty_type) {
                    'maskoni' => 'مسکونی',
                    'tejari' => 'تجاری',
                    'earth' => 'زمین',
                };
                return $item;
            })->appends($request->query());

        return view("pages.buyers.buyer_request.delete_list", compact('data'));
    }

    public function undelete(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'request_id' => 'required|exists:buyer_requests,id',
            'buyer_id' => 'required|exists:buyers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_undelete_buyer_request');
        }


        DB::table('buyer_requests')->whereId($request->request_id)->update([
            'is_deleted' => 0,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => null,
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "undelete_buyer_request";
        $description = " درخواست خرید $request->buyer_name فعال گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->back()->with('success_undelete_buyer_request', "درخواست خرید $request->buyer_name فعال گردید.");
    }
}
