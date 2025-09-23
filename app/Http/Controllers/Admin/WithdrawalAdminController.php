<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawalRequest;

class WithdrawalAdminController extends Controller
{
    public function index()
    {
        $requests = WithdrawalRequest::with('user')->latest()->get();
        return view('admin.withdrawals.index', compact('requests'));
    }

    public function update(Request $request, WithdrawalRequest $withdrawal)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_note' => 'nullable|string',
        ]);

        // Only allow update from pending
        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Withdrawal already processed.');
        }

        $withdrawal->status = $request->status;
        $withdrawal->admin_note = $request->admin_note;
        $withdrawal->save();

        if ($withdrawal->status === 'approved') {
            // Deduct the user's balance (double-check sufficient balance)
            $user = $withdrawal->user;
            if ($user->balance >= $withdrawal->amount) {
                $user->decrement('balance', $withdrawal->amount);
            } else {
                // If balance insufficient, mark rejected and tell admin
                $withdrawal->status = 'rejected';
                $withdrawal->admin_note = ($withdrawal->admin_note ?? '') . ' | Auto-rejected: insufficient balance';
                $withdrawal->save();
                return back()->with('error', 'User balance insufficient. Request rejected.');
            }
        }

        return back()->with('success', 'Withdrawal updated.');
    }
}
