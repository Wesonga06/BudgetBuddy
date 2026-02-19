<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController; 
use App\Http\Controllers\GoalController;        
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController; // Add this line to import the WalletController

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Authenticated Routes Group
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- DASHBOARD ---
    Route::get('/dashboard', [GoalController::class, 'index'])->name('dashboard');

    // --- TRANSACTIONS ---
    // The name MUST be 'transactions' to match your navigation bar
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions'); 
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // --- GOALS ---
    // The name MUST be 'goals' to match your navigation bar. 
    // We point it to the dashboard view since that's where goals are displayed.
    Route::get('/goals', [GoalController::class, 'index'])->name('goals');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    
    // Goals Actions (Deposit & Withdraw)
    Route::post('/goals/{id}/deposit', [GoalController::class, 'deposit'])->name('goals.deposit');
    Route::post('/goals/{id}/withdraw', [GoalController::class, 'withdraw'])->name('goals.withdraw');

    // --- PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- WALLET TOP-UP ---
    // 1. Shows the webpage with the form
    Route::get('/topup', function () {
    return view('topup');
    })->name('topup');

    // 2. Catches the form data when they click "Pay"
    Route::post('/test-mpesa', [WalletController::class, 'initiateTopUp']);

});


require __DIR__.'/auth.php';