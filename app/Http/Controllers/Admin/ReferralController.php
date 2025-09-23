<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralCommission;
class ReferralController extends Controller
{
   public function index()
    {
        $referrals = ReferralCommission::with(['user', 'referrer', 'property'])
            ->latest()
            ->paginate(10);

        return view('admin.referrals.index', compact('referrals'));
    }

    public function show(ReferralCommission $referral)
    {
        $referral->load(['user', 'referrer', 'property']);
        return view('admin.referrals.show', compact('referral'));
    }
}
