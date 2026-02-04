<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
       /* $validate = Validator::make(['seller_id' => $seller_id], [
            'seller_id' => 'required|exists:sellers,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_seller');
        }*/


        $data['archives'] = DB::table('request_sellers')
        ->join('sellers','request_sellers.seller_id','sellers.id')
        ->select([
            'request_sellers.*',
            'sellers.name as seller_name',
            'sellers.phone as seller_phone',
        ])
            ->where('request_sellers.is_deleted', 0)
            ->where('request_sellers.is_archive', 1)
            ->paginate(50)
            ->through(function ($item) {

                $item->images = DB::table('images_requests_seller')
                    ->where('request_seller_id', $item->id)
                    ->where('is_deleted', 0)
                    ->get(['path', 'id']);
                return $item;
            })->appends($request->query());
            // dd($data['archives']);

        return view("pages.archive.list", [
            'data'=>$data,
            'request_reoperty_type' => $request->request_reoperty_type,
            'search_request_type' => $request->search_request_type,
            'request_price' => $request->request_price,
            'request_address' => $request->request_address,
            'search_info_seller' => $request->search_info_seller,
        ]);
    }
}
