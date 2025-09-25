<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PayoutAdminController extends Controller
{
   public function index(Request $request)
    {
        $query = Payout::with('user');

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name','like','%'.$search.'%')
                  ->orWhere('email','like','%'.$search.'%');
            });
        }

        $payouts = $query->latest()->paginate(20)->withQueryString();
        return view('admin.payouts.index', compact('payouts'));
    }

    public function update(Request $request, Payout $payout)
    {
        $data = $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_note' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($payout, $data) {
            // Prevent double-approval
            if ($data['status'] === 'approved' && $payout->status !== 'approved') {
                $user = User::where('id', $payout->user_id)->lockForUpdate()->first();
                if (bccomp($user->balance, $payout->amount, 2) < 0) {
                    throw \Illuminate\Validation\ValidationException::withMessages(['amount' => 'Insufficient balance to approve.']);
                }
                $user->balance = bcsub($user->balance, $payout->amount, 2);
                $user->save();
            }

            $payout->update([
                'status' => $data['status'],
                'admin_note' => $data['admin_note'] ?? null,
            ]);
        });

        return redirect()->back()->with('success', 'Payout updated.');
    }
}
