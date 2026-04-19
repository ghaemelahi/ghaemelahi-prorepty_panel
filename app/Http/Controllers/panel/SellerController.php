<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\LogService;
use App\Http\Requests\sell\RequestSell\SellerDeleteRequest;
use App\Http\Requests\sell\RequestSell\SellerIndexRequest;
use App\Http\Requests\sell\RequestSell\SellerStoreRequest;
use App\Http\Requests\sell\RequestSell\SellerUnDeleteRequest as RequestSellSellerUnDeleteRequest;
use App\Http\Requests\sell\RequestSell\SellerUpdateRequest;
use App\Http\Requests\sellers\SellerUnDeleteRequest;
use App\Models\Seller;
use Morilog\Jalali\Jalalian;

use function App\Http\Helpers\english_number;

class SellerController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index(SellerIndexRequest $request)  {
        $search_name  = $request->search_name;
        $search_phone  = $request->search_phone;
        $search_gender  = $request->search_gender;


        $sellers = Seller::query()
        ->searchName($search_name)
        ->searchPhone($search_phone)
        ->searchGender($search_gender)
        ->paginate(50)->appends($request->query());
        return view("pages.sellers.list",compact('sellers','search_name','search_phone','search_gender'));
    }

    public function store(SellerStoreRequest $request) {

        $data = $request->all();
        $data['phone'] = english_number($request->phone);
        $data['created_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $data['updated_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $seller = Seller::query()->create($data);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "create_seller";
        $name = $request->name;
        $description = "فروشنده $name به سیستم اضافه گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('seller_requests',$seller->id)->with('success_create_seller', "فروشنده $name با موفقیت ایجاد شد");
    }

    public function update(SellerUpdateRequest $request, Seller $seller){

        $data = $request->all();
        $data['phone'] = english_number($request->phone);
        $data['updated_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $seller->update($data);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_seller";
        $name = $request->name;
        $description = "اطلاعات فروشنده $name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('sellers')->with('success_update_seller', "اطلاعات فروشنده $name بروزرسانی گردید.");
    }

    public function delete(SellerDeleteRequest $request,Seller $seller) {

        $seller->request_seller()->delete();
        $seller->delete();


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_seller";
        $description = "فروشنده $request->name از سیستم حذف گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('sellers')->with('success_delete_seller', "فروشنده $request->name با موفقیت حذف گردید.");
    }


    
    public function delete_list(Request $request)  {
        $data = Seller::query()->onlyTrashed()->paginate(50)->appends($request->query());
        return view("pages.sellers.delete_list",compact('data'));
    }

    public function undelete(RequestSellSellerUnDeleteRequest $request) {
        $seller = Seller::query()->onlyTrashed()->findOrFail($request->seller_id);
        // dd($seller);
        $seller->restore();
        $seller->request_seller()->restore();

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "undelete_seller";
        $description = "خریدار $request->name فعال گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->back()->with('success_undelete_seller', "خریدار $request->name با موفقیت فعال گردید.");
    }
}
