<?php

declare(strict_types=1);

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\LogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

use function App\Http\Helpers\english_number;

class BuyerController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index(Request $request)
    {
        $validate = validator::make($request->all(), [
            'search_name' => 'nullable|string|max:255',
            'search_phone' => 'nullable|string|max:11',
            'search_gender' => 'nullable|in:male,female',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_search_buyer');
        }
        $search_name  = $request->search_name;
        $search_phone  = $request->search_phone;
        $search_gender  = $request->search_gender;
        $buyers = DB::table('buyers')->where('is_deleted', 0);
        if (!empty($search_name)) {
            $buyers = $buyers->where('name', 'like', "%$search_name%");
        }
        if (!empty($search_phone)) {
            $buyers = $buyers->where('phone', 'like', "%$search_phone%");
        }

        if (!empty($search_gender)) {
            $buyers = $buyers->where('gender', "$search_gender");
        }
        $buyers = $buyers->paginate(50);
        return view("pages.buyers.list", compact('buyers', 'search_name', 'search_phone', 'search_gender'));
    }

    public function store(Request $request)
    {

        $validate = validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:buyers',
            'gender' => 'required|in:male,female',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_store_buyer');
        }

        $phone = english_number($request->phone);
      $buyer_id = DB::table('buyers')->insertGetId([
            'name' => $request->name,
            'phone' => $phone,
            'gender' => $request->gender,
            'created_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "create_buyer";
        $name = $request->name;
        $description = "خریدار $name به سیستم اضافه گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyer_requests',$buyer_id)->with('success_create_buyer', "خریدار $name با موفقیت ایجاد شد");
    }

    public function update(Request $request)
    {

        $validate = validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'gender' => 'required|in:male,female',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_update_buyer');
        }

        $phone = english_number($request->phone);
        DB::table('buyers')->whereId($request->buyer_id)->update([
            'name' => $request->name,
            'phone' => $phone,
            'gender' => $request->gender,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_buyer";
        $name = $request->name;
        $description = "اطلاعات خریدار $name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyers')->with('success_update_buyer', "اطلاعات خریدار $name بروزرسانی گردید.");
    }

    public function delete(Request $request)
    {

        $validate = validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
            'name' => 'required|string|max:255',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_delete_buyer');
        }

        DB::table('buyers')->whereId($request->buyer_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        DB::table('buyer_requests')->where('buyer_id', $request->buyer_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_buyer";
        $description = "خریدار $request->name از سیستم حذف گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyers')->with('success_delete_buyer', "خریدار $request->name با موفقیت حذف گردید.");
    }



    public function delete_list(Request $request)
    {
        $data = DB::table('buyers')->where('is_deleted', 1)->paginate(50)->appends($request->query());
        return view("pages.buyers.delete_list", compact('data'));
    }

    public function undelete(Request $request)
    {

        $validate = validator::make($request->all(), [
            'buyer_id' => 'required|exists:buyers,id',
            'name' => 'required|string|max:255',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_undelete_buyer');
        }

        DB::table('buyers')->whereId($request->buyer_id)->update([
            'is_deleted' => 0,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => null,
        ]);

        DB::table('buyer_requests')->where('buyer_id', $request->buyer_id)->update([
            'is_deleted' => 0,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => null,
        ]);


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "undelete_buyer";
        $description = "خریدار $request->name فعال گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->back()->with('success_undelete_buyer', "خریدار $request->name با موفقیت فعال گردید.");
    }
}
