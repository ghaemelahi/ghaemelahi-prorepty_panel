<?php

declare(strict_types=1);

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\LogService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

use function App\Http\Helpers\english_number;

// use Spatie\Browsershot\Browsershot;

class RequestSellerController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index(Request $request, $seller_id)
    {
        $data = $request->all();
        $data['buyer_id'] = $seller_id;

        $validate = Validator::make($data, [
            'buyer_id' => 'required|exists:sellers,id',
            'search_reoperty_type' => 'nullable',
            'search_request_type' => 'nullable|in:sell,ejareh',
            'search_price' => 'nullable',
            'search_bedrooms' => 'nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_seller');
        }

        $search_reoperty_type = $request->search_reoperty_type;
        $search_request_type = $request->search_request_type;
        $search_price = $request->search_price != null ? str_replace(',', '', $request->search_price) : null;
        $search_bedrooms = $request->search_bedrooms;

        $data['seller_info'] = DB::table('sellers')->whereId($seller_id)->first();


        $data['seller_requests'] = DB::table('request_sellers')
            ->where('is_deleted', 0)
            ->where('seller_id', $seller_id);

        if ($search_reoperty_type != null) {
            $data['seller_requests'] = $data['seller_requests']->where('reoperty_type', $search_reoperty_type);
        }
        if ($search_request_type != null) {
            $data['seller_requests'] = $data['seller_requests']->where('request_type', $search_request_type);
        }
        if ($search_price != null) {
            $data['seller_requests'] = $data['seller_requests']->where('price', $search_price);
        }
        if ($search_bedrooms != null) {
            $data['seller_requests'] = $data['seller_requests']->where('number_bedrooms', $search_bedrooms);
        }

        $data['seller_requests'] = $data['seller_requests']->paginate(50)
            ->through(function ($item) {

                $item->images = DB::table('images_requests_seller')
                    ->where('request_seller_id', $item->id)
                    ->where('is_deleted', 0)
                    ->get(['path', 'id']);
                return $item;
            })->appends($request->query());
        // dd($data['seller_requests']);

        return view("pages.sellers.request_seller.list", compact('data', 'search_reoperty_type', 'search_request_type', 'search_price', 'search_bedrooms'));
    }

    public function testExportPdf($request_id)
    {
        $validate = Validator::make(['request_id' => $request_id], [
            'request_id' => 'required|exists:request_sellers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_request');
        }

        $item = DB::table('request_sellers')
            ->join('sellers', 'request_sellers.seller_id', '=', 'sellers.id')
            ->select([
                'request_sellers.*',
                'sellers.name as seller_name',
                'sellers.phone as seller_phone',
            ])
            ->where('request_sellers.is_deleted', 0)
            ->where('request_sellers.id', $request_id)
            ->first();

        $imageRows = DB::table('images_requests_seller')
            ->where('request_seller_id', $request_id)
            ->where('is_deleted', 0)
            ->orderBy('id')
            ->limit(5)
            ->get(['path', 'id']);

        $images = $imageRows->map(function ($row) {
            $path = public_path($row->path);

            $obj = (object)[
                'id' => $row->id,
                'path' => $row->path,
                'data_uri' => null
            ];

            if (file_exists($path)) {
                $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

                $mime = match ($extension) {
                    'jpg', 'jpeg' => 'jpeg',
                    'png' => 'png',
                    'gif' => 'gif',
                    'webp' => 'webp',
                    default => 'jpeg',
                };

                $obj->data_uri = 'data:image/' . $mime . ';base64,' . base64_encode(file_get_contents($path));
            }

            return $obj;
        });

        $date = Jalalian::now()->format('Y/m/d');

        $pdf = Pdf::loadView('pages.sellers.request_seller.exportPDF', [
            'item'   => $item,
            'images' => $images,
            'date'   => $date,
        ])
            ->setPaper('a4', 'portrait'); // جایگزین format()

        return $pdf->download('request-' . $request_id . '.pdf');
    }

    /**
     * صفحهٔ چاپ/ذخیره PDF با JS خام (بدون کتابخانهٔ سرور — فارسی و عکس درست)
     */
    public function printPdf($request_id)
    {
        $validate = Validator::make(['request_id' => $request_id], [
            'request_id' => 'required|exists:request_sellers,id',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_request');
        }

        $item = DB::table('request_sellers')
            ->join('sellers', 'request_sellers.seller_id', '=', 'sellers.id')
            ->select([
                'request_sellers.*',
                'sellers.name as seller_name',
                'sellers.phone as seller_phone',
            ])
            ->where('request_sellers.is_deleted', 0)
            ->where('request_sellers.id', $request_id)
            ->first();

        $imageRows = DB::table('images_requests_seller')
            ->where('request_seller_id', $request_id)
            ->where('is_deleted', 0)
            ->orderBy('id')
            ->limit(5)
            ->get(['path', 'id']);

        $images = $imageRows->map(function ($row) {
            $path = public_path($row->path);
            $obj = (object) ['id' => $row->id, 'path' => $row->path, 'data_uri' => null];
            if (file_exists($path)) {
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $mime = match ($ext) {
                    'jpg', 'jpeg' => 'jpeg',
                    'png' => 'png',
                    'gif' => 'gif',
                    'webp' => 'webp',
                    default => 'jpeg',
                };
                $obj->data_uri = 'data:image/' . $mime . ';base64,' . base64_encode(file_get_contents($path));
            }
            return $obj;
        });

        $date = Jalalian::now()->format('Y/m/d');

        return view('pages.sellers.request_seller.printPDF', [
            'item'     => $item,
            'images'   => $images,
            'date'     => $date,
            'logo_url' => null, // برای نمایش لوگو: asset('path/to/logo.png')
        ]);
    }

    public function list_sells(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'request_reoperty_type' => 'nullable|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'search_request_type' => 'nullable|in:sell,ejareh',
            'request_price' => 'nullable|string',
            'request_address' => 'nullable|string',
            'search_info_seller' => 'nullable',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_seller');
        }

        $request->request_price = $request->request_price != null ? str_replace(",", "", $request->request_price) : '';
        // dd($request->all());
        $data['list_seller_requests'] = DB::table('request_sellers')
            ->join('sellers', 'request_sellers.seller_id', 'sellers.id')
            ->leftJoin('building_buyers', 'request_sellers.id', 'building_buyers.request_seller_id')
            ->select([
                'request_sellers.*',
                'sellers.name as seller_name',
                'sellers.phone as seller_phone',
                'building_buyers.buyer_name'
            ])
            ->where('request_sellers.is_deleted', 0);
        // ->where('building_buyers.buyer_name',null);
        if ($request->request_reoperty_type) {
            // dd($request->request_reoperty_type == 'earth');
            $data['list_seller_requests'] = $data['list_seller_requests']->where('reoperty_type', $request->request_reoperty_type);
        }
        if ($request->search_request_type) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where('request_type', $request->search_request_type);
        }
        if ($request->request_price) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where('price', $request->request_price);
        }
        if ($request->request_address) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where('street_name', 'LIKE', "%$request->request_address%");
        }
        if ($request->request_meterage_building) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where('meterage_building', $request->request_meterage_building);
        }
        if ($request->request_year_manufacture) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where('year_manufacture', $request->request_year_manufacture);
        }
        if ($request->request_document_type) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where('document_type', $request->request_document_type);
        }
        if ($request->search_info_seller) {
            $data['list_seller_requests'] = $data['list_seller_requests']->where(function ($query) use ($request) {
                $query->where('sellers.name', 'like', "%{$request->search_info_seller}%")
                    ->orWhere('sellers.phone', 'like', "%{$request->search_info_seller}%");
            });
        }
        $data['list_seller_requests'] = $data['list_seller_requests']->paginate(50)
            ->through(function ($item) {
                $item->persian_reoperty_type = match($item->reoperty_type){
                    'tejari'=>'تجاری',
                    'maskoni'=>'مسکونی',
                    'earth_maskoni'=>'زمین مسکونی',
                    'earth_tejari'=>'زمین تجاری',
                };

                $item->images = DB::table('images_requests_seller')
                    ->where('request_seller_id', $item->id)
                    ->where('is_deleted', 0)
                    ->first(['path', 'id']);
                return $item;
            })->appends($request->query());
        // $data['seller_info'] = DB::table('sellers')->whereId($seller_id)->first();

        // dd($data['list_seller_requests']);
        $data['buyers'] = DB::table('buyers')->where('is_deleted', 0)->get(['id', 'name', 'phone']);
        return view("pages.sellers.request_seller.list_sells", [
            'data' => $data,
            'request_reoperty_type' => $request->request_reoperty_type,
            'search_request_type' => $request->search_request_type,
            'request_price' => $request->request_price,
            'request_address' => $request->request_address,
            'search_info_seller' => $request->search_info_seller,
            'request_meterage_building' => $request->request_meterage_building,
            'request_year_manufacture' => $request->request_year_manufacture,
            'request_document_type' => $request->request_document_type,
        ]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'seller_id' => 'required|exists:sellers,id',
            'seller_phone' => 'required|exists:sellers,phone',
            'seller_name' => 'required',
            'reoperty_type' => 'required|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'request_type' => 'required|in:sell,ejareh',
            'price' => 'required',
            'down_payment' => 'nullable',
            'monthly_amount' => 'nullable',
            'address' => 'required',
            'street_name' => 'required',
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
            'images' => 'nullable|array|max:5',
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


        $request_seller_id = DB::table('request_sellers')->insertGetId([
            'seller_id' => $request->seller_id,
            'reoperty_type' => $request->reoperty_type,
            'price' => str_replace(",", "", english_number($request->price)),
            'down_payment' => str_replace(",", "", english_number($request->down_payment)),
            'monthly_amount' => str_replace(",", "", english_number($request->monthly_amount)),
            'request_type' => $request->request_type,
            'number_bedrooms' => english_number($request->number_bedrooms),
            'year_manufacture' => english_number($request->year_manufacture),
            'meterage_building' => english_number($request->meterage_building),
            'dimensions_building' => english_number($request->dimensions_building),
            'document_type' => english_number($request->document_type),
            'options' => $request->options,
            'water' => $request->water,
            'electric' => $request->electric,
            'gas' => $request->gas,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'street_name' => $request->street_name,
            'description' => $request->description ?? "_",
            'archive_date' => $archive_date,
            'created_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        if ($request->images) {
            foreach ($request->images as $image) {
                // if(is_file($image)){
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
                // }
            }
        }

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "create_seller_request";
        $description = "یک درخواست جدید برای $request->seller_name ثبت گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('seller_requests', $request->seller_id)->with('success_create_seller_request', "درخواست ثبت گردید.");
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'request_id' => 'required|exists:request_sellers,id',
            'seller_id' => 'required|exists:sellers,id',
            'seller_phone' => 'required|exists:sellers,phone',
            'seller_name' => 'required',
            'reoperty_type' => 'required|in:tejari,maskoni,earth_maskoni,earth_tejari',
            'request_type' => 'required|in:sell,ejareh',
            'price' => 'required',
            'down_payment' => 'nullable',
            'monthly_amount' => 'nullable',
            'address' => 'required',
            'street_name' => 'required',
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
            'images' => 'nullable|array|max:5',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_update_seller_request');
        }
        // dd($request->all());

        $request->description = $request->description ?? "_";
        $request->water = $request->water ?? 0;
        $request->electric = $request->electric ?? 0;
        $request->gas = $request->gas ?? 0;
        $request->telephone = $request->telephone ?? 0;
        $request->options = $request->options ?? "_";

        $request_seller_id = $request->request_id;
        DB::table('request_sellers')->whereId($request->request_id)->update([
            'seller_id' => $request->seller_id,
            'reoperty_type' => $request->reoperty_type,
            'price' => str_replace(",", "", english_number($request->price)),
            'down_payment' => str_replace(",", "", english_number($request->down_payment)),
            'monthly_amount' => str_replace(",", "", english_number($request->monthly_amount)),
            'request_type' => $request->request_type,
            'number_bedrooms' => english_number($request->number_bedrooms),
            'year_manufacture' => english_number($request->year_manufacture),
            'meterage_building' => english_number($request->meterage_building),
            'dimensions_building' => english_number($request->dimensions_building),
            'document_type' => english_number($request->document_type),
            'options' => $request->options,
            'water' => $request->water,
            'electric' => $request->electric,
            'gas' => $request->gas,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'street_name' => $request->street_name,
            'status' => $request->status,
            'description' => $request->description ?? "_",
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        if ($request->images) {
            foreach ($request->images as $image) {
                if ($image != null) {
                    dd(vars: $request->images);
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
            }
        }
        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_seller_request";
        $description = "درخواست فروش $request->seller_name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('seller_requests', $request->seller_id)->with('success_update_seller_request', "درخواست بروزرسانی گردید.");
    }

    public function delete(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'request_id' => 'required|exists:request_sellers,id',
            'seller_id' => 'required|exists:sellers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_delete_seller_request');
        }


        DB::table('request_sellers')->whereId($request->request_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        DB::table("images_requests_seller")->where("request_seller_id", $request->request_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_seller_request";
        $description = " درخواست $request->seller_name حذف گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('seller_requests', $request->seller_id)->with('success_delete_seller_request', "درخواست حذف گردید.");
    }





    public function delete_list(Request $request)
    {
        /* $validate = Validator::make(['buyer_id' => $buyer_id], [
            'buyer_id' => 'required|exists:buyers,id'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_buyer');
        }*/

        $data = DB::table('request_sellers')
            ->join('sellers', 'request_sellers.seller_id', 'sellers.id')
            ->select([
                'request_sellers.id',
                'request_sellers.request_type',
                'request_sellers.reoperty_type',
                'request_sellers.delete_at',
                'sellers.id as seller_id',
                'sellers.name',
                'sellers.phone',
            ])
            ->where('request_sellers.is_deleted', 1)->paginate(50)->through(function ($item) {
                $item->request_type = match ($item->request_type) {
                    'sell' => 'فروش',
                    'ejareh' => 'اجاره',
                };

                $item->reoperty_type = match ($item->reoperty_type) {
                    'maskoni' => 'مسکونی',
                    'tejari' => 'تجاری',
                    'earth_maskoni' => 'زمین مسکونی',
                    'earth_tejari' => 'زمین تجاری',
                };
                return $item;
            })->appends($request->query());

        return view("pages.sellers.request_seller.delete_list", compact('data'));
    }

    public function undelete(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'request_id' => 'required|exists:request_sellers,id',
            'seller_id' => 'required|exists:sellers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_undelete_seller_request');
        }


        DB::table('request_sellers')->whereId($request->request_id)->update([
            'is_deleted' => 0,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => null,
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "undelete_seller_request";
        $description = " درخواست فروش $request->seller_name فعال گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->back()->with('success_undelete_seller_request', "درخواست فروش $request->seller_name فروش فعال گردید.");
    }
}
