<?php

use App\Http\Controllers\Api\CurrencyConverterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/currency/convert', [CurrencyConverterController::class, 'convert'])->name('currency.convert');
