<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $goals = Goal::where('user_id', Auth::id())->get();
        return view('goals', ['goals' => $goals]);
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

        return redirect()->route('dashboard')->with('success', 'New savings goal set!');
    }

    public function deposit(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $goal = Goal::where('user_id', Auth::id())->findOrFail($id);
        $goal->current_amount += $request->amount;
        $goal->save();

        return back()->with('success', 'Amount deposited successfully!');
    }

    public function withdraw($id)
    { 
        $goal = Goal::where('id', $id)->where('user_id', Auth::id())->findOrFail($id);

        if ($goal->current_amount < $goal->target_amount) {
            return back()->withErrors(['amount' => 'You cannot withdraw until you reach your target amount.']);
        }

        $goal->current_amount = 0;
        $goal->save();

        return back()->with('success', 'Congratulations! You have reached your savings goal and can now withdraw.');
    }
}