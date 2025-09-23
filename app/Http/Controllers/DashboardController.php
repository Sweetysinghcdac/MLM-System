<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $referrer = $user->referrer;
        $directReferrals = $user->referrals()->withCount('referrals')->get();
        $totalDirect = $directReferrals->count();
        $totalCommission = $user->total_commission_earned;
        $balance = $user->balance;

        return view('dashboard.index', compact('user', 'referrer', 'directReferrals', 'totalDirect', 'totalCommission', 'balance'));
    }

    public function tree()
    {
        $user = Auth::user();
        $tree = $this->buildTree($user);
        return view('dashboard.tree', compact('tree'));
    }

    private function buildTree($user)
    {
        $node = [
            'user' => $user,
            'children' => []
        ];

        $user->load('referrals');

        foreach ($user->referrals as $child) {
            $node['children'][] = $this->buildTree($child);
        }

        return $node;
    }
}
