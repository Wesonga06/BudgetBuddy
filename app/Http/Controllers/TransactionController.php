<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Import the Transaction model
use Illuminate\Support\Facades\Auth; // Import Auth to get the current user

class TransactionController extends Controller
{
    // 1. Show the Transactions Page
    public function index()
    {
        // Get all transactions for the logged-in user, sorted by newest first
        $transactions = Transaction::where('user_id', Auth::id())
                        ->latest()
                        ->get();
                        
        return view('transactions', ['transactions' => $transactions]);
    }

    // 2. Save a New Transaction
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:income,expense',
            'source' => 'required|in:mpesa,bank',
            'description' => 'nullable|string|max:255',
        ]);

        // Create Record
        Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'type' => $request->type,
            'source' => $request->source,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaction added successfully!');
    }
}
