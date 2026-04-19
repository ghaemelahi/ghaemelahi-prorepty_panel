<?php

declare(strict_types=1);

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\LogService;
use App\Http\Requests\Buyers\BuyerDeleteRequest;
use App\Http\Requests\Buyers\BuyerIndexRequest;
use App\Http\Requests\Buyers\BuyerStoreRequest;
use App\Http\Requests\Buyers\BuyerUnDeleteRequest;
use App\Http\Requests\Buyers\BuyerUpdateRequest;
use App\Models\Buyer;
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
    public function index(BuyerIndexRequest $request)
    {
        $search_name  = $request->search_name;
        $search_phone  = $request->search_phone;
        $search_gender  = $request->search_gender;
        $buyers = Buyer::query()
            ->searchName($search_name)
            ->searchPhone($search_phone)
            ->searchGender($search_gender)
            ->paginate(50)->appends($request->query());
        return view("pages.buyers.list", compact('buyers', 'search_name', 'search_phone', 'search_gender'));
    }

    public function store(BuyerStoreRequest $request)
    {
        $data = $request->all();
        $data['phone'] = english_number($request->phone);
        $data['created_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $data['updated_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $buyer = Buyer::query()->create($data);
        // MARK:-> SAVE LOG USER SYSTEM
        $report = "create_buyer";
        $name = $request->name;
        $description = "خریدار $name به سیستم اضافه گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyer_requests', $buyer->id)->with('success_create_buyer', "خریدار $name با موفقیت ایجاد شد");
    }

    public function update(BuyerUpdateRequest $request,Buyer $buyer)
    {
        
        $data = $request->all();
        $data['phone'] = english_number($request->phone);
        $data['updated_at'] = Jalalian::now()->format("Y-m-d H:i:s");
        $buyer->update($data);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_buyer";
        $name = $request->name;
        $description = "اطلاعات خریدار $name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyers')->with('success_update_buyer', "اطلاعات خریدار $name بروزرسانی گردید.");
    }

    public function delete(BuyerDeleteRequest $request,Buyer $buyer)
    {
        $buyer->buyer_requests()->delete();
        $buyer->delete();
       /* DB::table('buyers')->whereId($request->buyer_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        DB::table('buyer_requests')->where('buyer_id', $request->buyer_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);*/


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_buyer";
        $description = "خریدار $request->name از سیستم حذف گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('buyers')->with('success_delete_buyer', "خریدار $request->name با موفقیت حذف گردید.");
    }



    public function delete_list(Request $request)
    {
        $data = Buyer::query()->onlyTrashed()->paginate(50)->appends($request->query());
        return view("pages.buyers.delete_list", compact('data'));
    }

    public function undelete(BuyerUnDeleteRequest $request)
    {
        $buyer = Buyer::query()->onlyTrashed()->findOrFail($request->buyer_id);
        $buyer->restore();
        $buyer->buyer_requests()->restore();
        // DB::table('buyers')->whereId($request->buyer_id)->update([
        //     'is_deleted' => 0,
        //     'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        //     'delete_at' => null,
        // ]);

        // DB::table('buyer_requests')->where('buyer_id', $request->buyer_id)->update([
        //     'is_deleted' => 0,
        //     'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        //     'delete_at' => null,
        // ]);


        // MARK:-> SAVE LOG USER SYSTEM
        $report = "undelete_buyer";
        $description = "خریدار $request->name فعال گردید";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->back()->with('success_undelete_buyer', "خریدار $request->name با موفقیت فعال گردید.");
    }
}
