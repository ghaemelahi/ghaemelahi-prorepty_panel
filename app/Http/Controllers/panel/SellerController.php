<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\LogService;
use Morilog\Jalali\Jalalian;

use function App\Http\Helpers\english_number;

class SellerController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index(Request $request)  {

        $validate = validator::make($request->all(), [
            'search_name' => 'nullable|string|max:255',
            'search_phone' => 'nullable|string|max:11',
            'search_gender' => 'nullable|in:male,female',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_search_seller');
        }
        $search_name  = $request->search_name;
        $search_phone  = $request->search_phone;
        $search_gender  = $request->search_gender;


        $sellers = DB::table('sellers')->where('is_deleted',0);
        if(!empty($search_name)){
            $sellers = $sellers->where('name','like',"%$search_name%");
        }

        if(!empty($search_phone)){
            $sellers = $sellers->where('phone','like',"%$search_phone%");
        }

        if(!empty($search_gender)){
            $sellers = $sellers->where('gender',"$search_gender");
        }
        $sellers = $sellers->paginate(50)->appends($request->query());
        return view("pages.sellers.list",compact('sellers','search_name','search_phone','search_gender'));
    }

    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:sellers',
            'gender' => 'required|in:male,female',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_store_seller');
        }

        $phone = english_number($request->phone);
        DB::table('sellers')->insert([
            'name'=>$request->name,
            'phone'=>$phone,
            'gender'=>$request->gender,
            'created_at'=>Jalalian::now()->format("Y-m-d H:i:s"),
            'updated_at'=>Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "create_seller";
        $name = $request->name;
        $description = "فروشنده $name به سیستم اضافه گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('sellers')->with('success_create_seller', "فروشنده $name با موفقیت ایجاد شد");
    }

    public function update(Request $request){
        $validate = validator::make($request->all(), [
            'seller_id' => 'required|exists:sellers,id',
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'gender' => 'required|in:male,female',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_update_seller');
        }

        $phone = english_number($request->phone);
        DB::table('sellers')->whereId($request->seller_id)->update([
            'name'=>$request->name,
            'phone'=>$phone,
            'gender'=>$request->gender,
            'updated_at'=>Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_seller";
        $name = $request->name;
        $description = "اطلاعات فروشنده $name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('sellers')->with('success_update_seller', "اطلاعات فروشنده $name بروزرسانی گردید.");
    }

    public function delete(Request $request) {
        $validate = validator::make($request->all(), [
            'seller_id' => 'required|exists:sellers,id',
            'name' => 'required|string|max:255',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_delete_seller');
        }

        DB::table('sellers')->whereId($request->seller_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_seller";
        $description = "فروشنده $request->name از سیستم حذف گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('sellers')->with('success_delete_seller', "فروشنده $request->name با موفقیت حذف گردید.");
    }


    
    public function delete_list(Request $request)  {
        $data = DB::table('sellers')->where('is_deleted',1)->paginate(50)->appends($request->query());
        return view("pages.sellers.delete_list",compact('data'));
    }

    public function undelete(Request $request) {
        
        $validate = validator::make($request->all(), [
            'seller_id' => 'required|exists:sellers,id',
            'name' => 'required|string|max:255',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_undelete_seller');
        }

        DB::table('sellers')->whereId($request->seller_id)->update([
            'is_deleted' => 0,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => null,
        ]);

        DB::table('request_sellers')->where('seller_id',$request->seller_id)->update([
            'is_deleted' => 0,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => null,
        ]);


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "undelete_seller";
        $description = "خریدار $request->name فعال گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->back()->with('success_undelete_seller', "خریدار $request->name با موفقیت فعال گردید.");
    }
}
