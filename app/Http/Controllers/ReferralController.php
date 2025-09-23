<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferralCommission;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Fetch commissions earned
        $commissions = ReferralCommission::with(['user', 'property'])
            ->where('referrer_id', $user->id)
            ->latest()
            ->get();

        // Fetch downline by level
        $downline = [
            1 => $user->referrals,
            2 => $user->referrals->flatMap->referrals,
            3 => $user->referrals->flatMap->referrals->flatMap->referrals,
        ];

        return view('referrals.dashboard', compact('commissions', 'downline'));
    }
}
