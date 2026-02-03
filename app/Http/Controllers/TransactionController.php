<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; 
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // 1. Show the Transactions Page
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
                        ->orderBy('date', 'desc') // Sort by the Transaction Date, not just created_at
                        ->get();
                        
        return view('transactions', ['transactions' => $transactions]);
    }

    // 2. Save a New Transaction
    public function store(Request $request)
    {
        // 1. Validate (Added 'date')
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'type' => 'required|in:income,expense',
            'source' => 'required|in:mpesa,bank',
            'date' => 'required|date',               // <--- CRITICAL: Required by DB now
            'description' => 'nullable|string|max:255',
        ]);

        // 2. Create the Record
        Transaction::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'type' => $request->type,
            'source' => $request->source,
            'date' => $request->date,               // <--- Save the date
            'description' => $request->description,
        ]);

        // 3. ACTUAL MONEY LOGIC (Update User Balance)
        // If I add an expense, my balance should go down!
        $user = Auth::user();

        if ($request->type == 'income') {
            // Add money
            if ($request->source == 'mpesa') {
                $user->mpesa_balance += $request->amount;
            } else {
                $user->bank_balance += $request->amount;
            }
        } elseif ($request->type == 'expense') {
            // Subtract money
            if ($request->source == 'mpesa') {
                $user->mpesa_balance -= $request->amount;
            } else {
                $user->bank_balance -= $request->amount;
            }
        }
        
        $user->save(); // Save the new balance

        return redirect()->route('dashboard')->with('status', 'Transaction added & Balance updated!');
    }
}