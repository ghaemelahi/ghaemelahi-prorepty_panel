<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\panel\ArchiveController;
use App\Http\Controllers\panel\BuildingBuyerController;
use App\Http\Controllers\panel\BuyerController;
use App\Http\Controllers\panel\BuyerRequestController;
use App\Http\Controllers\panel\ChangeImageController;
use App\Http\Controllers\panel\customer\CustomerRequestSellController;
use App\Http\Controllers\panel\RequestSellerController;
use App\Http\Controllers\panel\SellerController;
use App\Http\Controllers\panel\UserController;




// Route::get("create_request", function () {
//     return view("customer_panel.request_sell.create");
// });

Route::prefix('customer_sell')->group(function(){
    Route::get('/',[CustomerRequestSellController::class,'index'])->name('customer_request_sell');
    Route::post('/store',[CustomerRequestSellController::class,'store'])->name('customer_request_sell_store');
});
Route::middleware(['auth','check_active'])->group(function () {
    // route panel

    // User System
    Route::prefix('user_system')->middleware(['role:admin'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user_system');
        Route::post('/store', [UserController::class, 'store'])->name('user_system_store');
        Route::post('/update', [UserController::class, 'update'])->name('user_system_update');
        Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('user_system_delete');
        Route::get('/user_report/{user_id}', [UserController::class, 'user_report'])->name('user_system_report');
    });

    // Buyers System
    Route::prefix('buyer')->group(function () {
        Route::get('/', [BuyerController::class, 'index'])->name('buyers');
        Route::post('/store', [BuyerController::class, 'store'])->name('buyer_store');
        Route::put('/update/{buyer}', [BuyerController::class, 'update'])->name('buyer_update');
        Route::delete('/delete/{buyer}', [BuyerController::class, 'delete'])->name('buyer_delete');
        Route::post('/undelete', [BuyerController::class, 'undelete'])->name('buyer_undelete');
    });

    // Buyer Requests System
    Route::prefix('buyer_request')->group(function () {
        Route::get('/list_buyers', [BuyerRequestController::class, 'list_buyers'])->name('list_buyers_requests');
        Route::get('/rent_list', [BuyerRequestController::class, 'rent_list_buyers'])->name('rent_list_requests');
        Route::get('/{buyer}', [BuyerRequestController::class, 'index'])->name('buyer_requests');
        Route::get('proposal_building_list/{buyer_id}', [BuyerRequestController::class, 'proposal_building_list'])->name('proposal_building_list');
        Route::post('/store', [BuyerRequestController::class, 'store'])->name('buyer_request_store');
        Route::put('/update/{buyerRequest}', [BuyerRequestController::class, 'update'])->name('buyer_request_update');
        Route::delete('/delete/{buyerRequest}', [BuyerRequestController::class, 'delete'])->name('buyer_request_delete');
        Route::post('/undelete', [BuyerRequestController::class, 'undelete'])->name('buyer_request_undelete');
    });

    // sellers System
    Route::prefix('seller')->group(function () {
        Route::get('/', [SellerController::class, 'index'])->name('sellers');
        Route::post('/store', [SellerController::class, 'store'])->name('seller_store');
        Route::put('/update/{seller}', [SellerController::class, 'update'])->name('seller_update');
        Route::delete('/delete/{seller}', [SellerController::class, 'delete'])->name('seller_delete');
        Route::post('/undelete', [SellerController::class, 'undelete'])->name('seller_undelete');
    });

    // seller Requests System
    Route::prefix('seller_request')->group(function () {
        Route::get('/list_sells', [RequestSellerController::class, 'list_sells'])->name('list_sells_requests');
        Route::get('/rent_list_sells', [RequestSellerController::class, 'rent_list_sells'])->name('rent_list_sells_requests');
        Route::get('/{seller_id}', [RequestSellerController::class, 'index'])->name('seller_requests');
        Route::post('/store', [RequestSellerController::class, 'store'])->name('seller_request_store');
        Route::post('/update', [RequestSellerController::class, 'update'])->name('seller_request_update');
        Route::post('/delete', [RequestSellerController::class, 'delete'])->name('seller_request_delete');
        Route::post('/undelete', [RequestSellerController::class, 'undelete'])->name('seller_request_undelete');
        Route::get('/test_export_pdf/{request_id}', [RequestSellerController::class, 'testExportPdf'])->name('seller_request_test_export_pdf');
        Route::get('/print_pdf/{request_id}', [RequestSellerController::class, 'printPdf'])->name('seller_request_print_pdf');
    });

    // seller Requests System
    Route::prefix('change_image_seller_request')->group(function () {
        Route::get('/{request_seller_id}', [ChangeImageController::class, 'index'])->name('change_image_seller_requests');
        Route::post('/update', [ChangeImageController::class, 'update'])->name('change_image_seller_request_update');
        Route::post('/delete', [ChangeImageController::class, 'delete'])->name('change_image_seller_request_delete');
    });

    // building buy routes
    Route::prefix('building_sell')->group(function () {
        Route::post('/building_sell', [BuildingBuyerController::class, 'building_sell'])->name('building_sell');
        Route::post('/update', [BuildingBuyerController::class, 'update'])->name('building_sell_update');
        Route::post('/delete', [BuildingBuyerController::class, 'delete'])->name('building_sell_delete');
    });

    // building Archive routes
    Route::prefix('archives')->group(function () {
        Route::get('/', [ArchiveController::class, 'index'])->name('archives');
    });


    Route::prefix('delete')->group(function () {
        Route::get('/buyers',[BuyerController::class,'delete_list'])->name('delete_buyers_list');
        Route::get('/sellers',[SellerController::class,'delete_list'])->name('delete_sellers_list');
        Route::get('/buyer_request',[BuyerRequestController::class,'delete_list'])->name('delete_buyer_request_list');
        Route::get('/request_seller',[RequestSellerController::class,'delete_list'])->name('delete_request_seller_list');
    });
    // route auth
    Route::get('/', [IndexController::class, 'index'])->name('dashbord');
});
Route::fallback(function(){
    return redirect()->route('dashbord');
});

require __DIR__.'/auth.php';
