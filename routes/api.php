<?php

use App\Http\Controllers\CronJob\ArchiveRequestSellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// cron job archive_request_sell for update request add to archive list
Route::get('archive_request_sell',[ArchiveRequestSellerController::class,'archive_request_sell']);
