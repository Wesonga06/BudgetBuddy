<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // CRITICAL IMPORT

Route::get('/', function () { return view('index'); });

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected Dashboard
Route::get('/dashboard', function () { 
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

