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
}