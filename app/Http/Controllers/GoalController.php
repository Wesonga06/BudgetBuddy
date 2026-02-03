<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Transaction; // <--- Import Transaction
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch goals
        $goals = \App\Models\Goal::where('user_id', $user->id)->get();
        
        // Fetch recent transactions for the history table
        $transactions = Transaction::where('user_id', $user->id)
                                   ->orderBy('date', 'desc')
                                   ->take(5)
                                   ->get();

        // Pass everything to the dashboard view
        return view('dashboard', [
            'goals' => $goals,
            'mpesaBalance' => $user->mpesa_balance, // Pass real balance
            'bankBalance' => $user->bank_balance,   // Pass real balance
            'transactions' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'target_amount' => 'required|numeric|min:1',
        ]);

        Goal::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'target_amount' => $request->target_amount,
            'current_amount' => 0,
        ]);

        return redirect()->route('dashboard')->with('status', 'New savings goal set!');
    }

    // Inside GoalController.php

public function deposit(Request $request, $id)
{
    $request->validate(['amount' => 'required|numeric|min:1']);

    $user = Auth::user();
    $goal = Goal::where('user_id', $user->id)->findOrFail($id);

    // 1. Check if user has enough money in MPESA
    if ($user->mpesa_balance < $request->amount) {
        return back()->withErrors(['amount' => 'Insufficient funds in MPESA!']);
    }

    // 2. Subtract from Wallet
    $user->mpesa_balance -= $request->amount;
    $user->save();

    // 3. Add to Goal
    $goal->current_amount += $request->amount;
    $goal->save();

    // 4. Create Transaction Record
        \App\Models\Transaction::create([
        'user_id' => $user->id,
        'type' => 'deposit',
        'amount' => $request->amount,
        'source' => 'mpesa',
        'description' => "Saved for {$goal->title}",
        'date' => now(),
    ]);

    return back()->with('status', 'Amount deposited successfully!');
}

    public function withdraw($id)
    { 
        $user = Auth::user();
        $goal = Goal::where('id', $id)->where('user_id', $user->id)->findOrFail($id);

        if ($goal->current_amount < $goal->target_amount) {
            return back()->withErrors(['amount' => 'You cannot withdraw until you reach your target amount.']);
        }

        // 1. Move money to Bank Balance
        $amount = $goal->current_amount;
        $user->bank_balance += $amount;
        $user->save();

        // 2. Reset Goal
        $goal->current_amount = 0;
        $goal->save();

        // 3. Create Transaction Record
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'withdraw',
            'amount' => $amount,
            'source' => 'bank',            // <--- Money goes to Bank
            'description' => "Goal Reached: {$goal->title}",
            'date' => now(),               // <--- Required Date
        ]);

        // Return with 'confetti' session key to trigger animation
        return back()->with('status', 'Goal achieved! Funds moved to Bank Account.')->with('confetti', true);
    }
}