<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController; // Import the WalletController

Route::post('/mpesa/update-database', [WalletController::class, 'updateDatabase']); // This is the endpoint Node will call with the M-Pesa receipt

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
