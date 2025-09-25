<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Payout;
use App\Models\WithdrawalRequest;
use App\Models\Commission;

class AdminDashboardController extends Controller
{
    // public function index()
    // {
    //     $usersCount = User::count();
    //     $transactionsCount = Transaction::count();
    //     $payoutsCount = Payout::count();
    //     $withdrawalsCount = WithdrawalRequest::count();

    //     return view('admin.dashboard', compact('usersCount', 'transactionsCount', 'payoutsCount', 'withdrawalsCount'));
    // }
      public function index(Request $request)
    {
        // Stats
        $totalUsers = User::count();
        $newUsers = User::where('created_at', '>=', now()->subDays(30))->count();

        $totalCommissions = Commission::sum('amount');
        $totalPendingPayouts = Payout::where('status','pending')->sum('amount');

        // Activity feed (latest registrations and payout requests)
        $recentUsers = User::latest()->take(6)->get(['id','name','email','created_at']);
        $recentPayouts = Payout::with('user')->latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalUsers','newUsers','totalCommissions','totalPendingPayouts','recentUsers','recentPayouts'
        ));
    }
}
