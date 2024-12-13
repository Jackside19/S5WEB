<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/produk', App\Http\Controllers\Api\produkController::class);
Route::apiResource('/karyawan', App\Http\Controllers\Api\karyawanController::class);
