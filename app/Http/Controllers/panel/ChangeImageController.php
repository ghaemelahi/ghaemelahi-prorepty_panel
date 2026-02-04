<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use LogService;
use Morilog\Jalali\Jalalian;

class ChangeImageController extends Controller
{
    protected $logService;

    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function index($request_seller_id)
    {
        $validate = Validator::make(['request_seller_id' => $request_seller_id], [
            'request_seller_id' => 'required|exists:request_sellers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_not_found_seller_request');
        }

        $data['seller_info'] = DB::table('request_sellers')
            ->join('sellers', 'request_sellers.seller_id', 'sellers.id')
            ->select([
                'sellers.name',
                'sellers.id as seller_id',
                'request_sellers.id as request_seller_id',
            ])
            ->where('request_sellers.id', $request_seller_id)->first();

        $data['images'] = DB::table('images_requests_seller')
            ->where('request_seller_id', $request_seller_id)
            ->where('is_deleted', 0)
            ->get(['path', 'id']);


        return view("pages.sellers.request_seller.change_images", compact('data'));
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'images_requests_seller_id' => 'required|exists:images_requests_seller,id',
            'request_seller_id' => 'required|exists:request_sellers,id',
            'image' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_update_change_seller_request');
        }

        // delete Image request
        $data_image = DB::table('images_requests_seller')
            ->whereId($request->images_requests_seller_id)
            ->first(['path', 'id']);

        Storage::delete($data_image->path);

        // update image
        $path = "images/sellers/documents/$request->request_seller_id";
        $file = $request->image;
        $name = $file->getClientOriginalName();
        Storage::putFileAs($path, $file, $name);
        DB::table('images_requests_seller')->whereId($request->images_requests_seller_id)->update([
            'request_seller_id' => $request->request_seller_id,
            'path' => "$path/$name",
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "update_image_seller_request";
        $description = "عکس درخواست $request->seller_name بروزرسانی گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('change_image_seller_requests', $request->request_seller_id)->with('success_update_change_image_seller_request', "عکس با موفقیت بروزرسانی گردید.");
    }


    public function delete(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'images_requests_seller_id' => 'required|exists:images_requests_seller,id',
            'request_seller_id' => 'required|exists:request_sellers,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate, 'error_delete_change_seller_request');
        }

        // delete image
        DB::table('images_requests_seller')->whereId($request->images_requests_seller_id)->update([
            'is_deleted' => 1,
            'updated_at' => Jalalian::now()->format("Y-m-d H:i:s"),
            'delete_at' => Jalalian::now()->format("Y-m-d H:i:s"),
        ]);

        // MARK:-> SAVE LOG USER SYSTEM
        $report = "delete_image_seller_request";
        $description = "عکس درخواست $request->seller_name حذف گردید.";
        $this->logService->saveLog($report, $description);
        // MARK:-> END SAVE LOG USER SYSTEM
        return redirect()->route('change_image_seller_requests', $request->request_seller_id)->with('success_delete_change_image_seller_request', "عکس با موفقیت بروزرسانی گردید.");
    }
}
