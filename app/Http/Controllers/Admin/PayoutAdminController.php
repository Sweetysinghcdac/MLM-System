<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;

class PayoutAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Payout::with('user');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by user name or email
        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
            });
        }

        $payouts = $query->latest()->paginate(15)->withQueryString();

        return view('admin.payouts.index', compact('payouts'));
    }

    public function update(Request $request, Payout $payout)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_note' => 'nullable|string|max:255',
        ]);

        $payout->status = $request->status;
        $payout->admin_note = $request->admin_note;
        $payout->save();

        return redirect()->back()->with('success', 'Payout updated successfully.');
    }
}
