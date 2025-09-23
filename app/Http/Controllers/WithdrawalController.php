<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WithdrawalRequest;


class WithdrawalController extends Controller
{
      public function index()
    {
        $requests = WithdrawalRequest::where('user_id', Auth::id())->latest()->get();
        return view('withdrawals.index', compact('requests'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'amount' => 'required|numeric|min:100', // min withdrawal ₹100
        ]);

        if ($request->amount > $user->balance) {
            return back()->with('error', 'Insufficient balance.');
        }

        WithdrawalRequest::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
        ]);

        return back()->with('success', 'Withdrawal request submitted successfully!');
    }
}
