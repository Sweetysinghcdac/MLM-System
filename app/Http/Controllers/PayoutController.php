<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payout;

class PayoutController extends Controller
{
      public function index()
    {
        $user = Auth::user();
        $payouts = $user->payouts()->latest()->get();
        return view('payouts.index', compact('user', 'payouts'));
    }

    public function requestForm()
    {
        $user = Auth::user();
        return view('payouts.request', compact('user'));
    }

    public function requestStore(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'amount' => 'required|numeric|min:1|max:'.$user->balance,
        ]);

        $threshold = 1000.00; // minimum allowed payout request

        if ((float)$request->amount < $threshold) {
            return back()->withErrors(['amount' => 'Minimum payout request is '.$threshold]);
        }

        Payout::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'pending',
            'note' => null,
        ]);

        return redirect()->route('payouts.index')->with('success', 'Payout requested and is pending admin approval.');
    }
    // Admin methods to approve/pay would be separate
}
