<?php

use App\Http\Controllers\Api\V1\LaporanPenjualanController;
use Illuminate\Support\Facades\Route;

Route::middleware('my-auth-api')->group(function () {
    Route::prefix("laporan-penjualan")->group(function () {
        Route::get("/", [LaporanPenjualanController::class, 'get']);
    });
});