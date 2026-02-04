<?php
declare(strict_types= 1);
namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use LogService;
use Morilog\Jalali\Jalalian;

class BuildingBuyerController extends Controller
{
    protected $logService;
    public function __construct(LogService $logService){
        $this->logService = $logService;
    }

    public function building_sell(Request $request) {
        $validate = Validator::make($request->all(),[
            'buyer_id' => 'required|exists:buyers,id',
            'request_seller_id' => 'required|exists:request_sellers,id',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->with('error_add_building_sell','اطلاعات وارد شده نامعتبر است.');
        }


        $buyer_info = buyer_info($request->buyer_id);
        DB::table('building_buyers')->insert([
            'buyer_id'=>$request->buyer_id,
            'request_seller_id'=>$request->request_seller_id,
            'buyer_name'=>$buyer_info->name,
            'buyer_phone'=>$buyer_info->phone,
            'created_at'=>Jalalian::now()->format("Y-m-d H:i:s"),
            'updated_at'=>Jalalian::now()->format("Y-m-d H:i:s"),
        ]);
        
        DB::table('request_sellers')->whereId($request->request_id)->update([
            'status' => 'compelet',
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "sell_prorepty_to_buyer";
        $description = "ملک فروشنده محترم $request->seller_name به خریدار محترم $buyer_info->name فروخته شد.";
        $this->logService->saveLog($report,$description);
        // MARK:-> END SAVE LOG USER SYSTEM

        return redirect()->back()->with('success_sell_building_to_buyer',"ملک $request->seller_name به $buyer_info->name فروخته شد.");
    }
}
