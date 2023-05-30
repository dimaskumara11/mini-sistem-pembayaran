<?php

use App\Http\Controllers\Api\V1\LaporanPenjualanController;
use App\Http\Controllers\Api\V1\PembayaranController;
use Illuminate\Support\Facades\Route;

Route::middleware('my-auth-api')->group(function () {
    Route::prefix("laporan-penjualan")->group(function () {
        Route::get("/", [LaporanPenjualanController::class, 'get']);
    });
    Route::prefix("pembayaran")->group(function () {
        Route::post("/bayar", [PembayaranController::class, 'bayar']);
        Route::post("/bayar-cicilan/{id_pembayaran}", [PembayaranController::class, 'bayarCicilan']);
    });
});