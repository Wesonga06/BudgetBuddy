<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Calculate MPESA balance (Incomes - Expenses)
        $mpesaIncome = Transaction::where('user_id', $user->id)->where('source', 'mpesa')->where('type', 'income')->sum('amount');
        $mpesaExpense = Transaction::where('user_id', $user->id)->where('source', 'mpesa')->where('type', 'expense')->sum('amount');
        $mpesaBalance = $mpesaIncome - $mpesaExpense;

        // Calculate Bank balance
        $bankIncome = Transaction::where('user_id', $user->id)->where('source', 'bank')->where('type', 'income')->sum('amount');
        $bankExpense = Transaction::where('user_id', $user->id)->where('source', 'bank')->where('type', 'expense')->sum('amount');
        $bankBalance = $bankIncome - $bankExpense;

        // Get all user goals
        $goals = Goal::where('user_id', $user->id)->get();

        return view('dashboard', compact('mpesaBalance', 'bankBalance', 'goals'));
    }
}