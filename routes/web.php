<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Authenticated Routes Group (Requires Login & Email Verification)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard - Uses the Controller to calculate totals
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transactions Page - Currently just shows the view
    Route::get('/transactions', function () {
        return view('transactions');
    })->name('transactions');

    // Goals Page - Currently just shows the view
    Route::get('/goals', function () {
        return view('goals');
    })->name('goals');

    // Profile Settings (Password, Name, Delete Account)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Load Authentication Routes (Login, Register, Reset Password)
require __DIR__.'/auth.php';