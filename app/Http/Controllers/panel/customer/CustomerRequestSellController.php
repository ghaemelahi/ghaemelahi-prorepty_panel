<?php
declare(strict_types= 1);
namespace App\Http\Controllers\panel\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

class CustomerRequestSellController extends Controller
{
    public function index(Request $request){
        return view("customer_panel.request_sell.create");
    }

    

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'seller_phone' => 'required|exists:sellers,phone',
            'seller_name' => 'required',
            'reoperty_type' => 'required|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'request_type' => 'required|in:sell,ejareh',
            'price' => 'required',
            'address' => 'required',
            'year_manufacture' => 'required',
            'meterage_building' => 'required',
            'dimensions_building' => 'required',
            'document_type' => 'required',
            'number_bedrooms' => 'required',
            'options' => 'nullable',
            'water' => 'nullable',
            'electric' => 'nullable',
            'gas' => 'nullable',
            'telephone' => 'nullable',
            'description' => 'nullable',
            'images' => 'required|array|max:5',
        ]);

        if ($validate->fails()) {
            
            return redirect()->back()->withErrors($validate, 'error_create_seller_request');
        }
        $request->description = $request->description ?? "_";
        $request->water = $request->water ?? 0;
        $request->electric = $request->electric ?? 0;
        $request->gas = $request->gas ?? 0;
        $request->telephone = $request->telephone ?? 0;
        $request->options = $request->options ?? "_";

        $archive_date = $request->request_type == 'ejareh' ? Jalalian::now()->addDays(40)->format('Y-m-d') : null;

        
        $seller_id = found_seller($request->seller_phone,$request->seller_name,$request->gender);

        
        $request_seller_id = DB::table('request_sellers')->insertGetId([
            'seller_id' => $seller_id,
            'reoperty_type' => $request->reoperty_type,
            'price' => str_replace(",", "", $request->price),
            'request_type' => $request->request_type,
            'number_bedrooms' => $request->number_bedrooms,
            'year_manufacture' => $request->year_manufacture,
            'meterage_building' => $request->meterage_building,
            'dimensions_building' => $request->dimensions_building,
            'document_type' => $request->document_type,
            'options' => $request->options,
            'water' => $request->water,
            'electric' => $request->electric,
            'gas' => $request->gas,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'description' => $request->description ?? "_",
            'archive_date' => $archive_date,
            'created_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        foreach ($request->images as $image) {
            $path = "images/sellers/documents/$request_seller_id";
            $file = $image;
            $name = $file->getClientOriginalName();
            Storage::putFileAs($path, $file, $name);
            DB::table('images_requests_seller')->insert([
                'request_seller_id' => $request_seller_id,
                'path' => "$path/$name",
                'created_at' => Jalalian::now()->format("Y-m-d H:i:s"),
                'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            ]);
        }

        // MARK:-> SAVE LOG USER SYSTEM
      /*  $report = "create_seller_request";
        $description = "یک درخواست جدید برای $request->seller_name ثبت گردید.";
        $this->logService->saveLog($report, $description);*/
        // MARK:-> END SAVE LOG USER SYSTEM
        $gender = $request->gender == 'male' ? 'جناب آقای' : 'سرکار خانم';
        return redirect()->back()->with('success_create_seller_request_customer', "$gender $request->seller_name درخواست شما با موفقیت ثبت گردید.");
    }
}
