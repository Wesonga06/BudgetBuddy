<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController; // Added
use App\Http\Controllers\GoalController;        // Added
use Illuminate\Support\Facades\Route;

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Authenticated Routes Group
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Transactions (View Page & Save New Transaction)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // Goals (View Page & Save New Goal)
    Route::get('/goals', [GoalController::class, 'index'])->name('goals');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    
    //Goals (Deposit $Withdraw)
    Route::post('/goals/{id}/deposit', [GoalController::class, 'deposit'])->name('goals.deposit');
    Route::post('/goals/{id}/withdraw', [GoalController::class, 'withdraw'])->name('goals.withdraw');

    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Load Authentication Routes
require __DIR__.'/auth.php';