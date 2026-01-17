<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Required to find the transactions table
use App\Models\Goal;        // Required to find the goals table
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // 1. Calculate MPESA balance
        // We sum all 'income' and subtract all 'expense' for 'mpesa' source
        $mpesaIncome = Transaction::where('user_id', $user->id)
            ->where('source', 'mpesa')
            ->where('type', 'income')
            ->sum('amount');

        $mpesaExpense = Transaction::where('user_id', $user->id)
            ->where('source', 'mpesa')
            ->where('type', 'expense')
            ->sum('amount');

        $mpesaBalance = $mpesaIncome - $mpesaExpense;

        // 2. Calculate Bank balance
        $bankIncome = Transaction::where('user_id', $user->id)
            ->where('source', 'bank')
            ->where('type', 'income')
            ->sum('amount');

        $bankExpense = Transaction::where('user_id', $user->id)
            ->where('source', 'bank')
            ->where('type', 'expense')
            ->sum('amount');

        $bankBalance = $bankIncome - $bankExpense;

        // 3. Get Goals
        $goals = Goal::where('user_id', $user->id)->get();

        // Pass variables to the view
        return view('dashboard', [
            'mpesaBalance' => $mpesaBalance,
            'bankBalance' => $bankBalance,
            'goals' => $goals
        ]);
    }
}