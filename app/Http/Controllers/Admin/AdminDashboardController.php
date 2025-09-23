<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Payout;
use App\Models\WithdrawalRequest;
use App\Models\Property;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $transactionsCount = Transaction::count();
        $payoutsCount = Payout::count();
        $withdrawalsCount = WithdrawalRequest::count();
        $propertiesCount = Property::count();

        return view('admin.dashboard', compact('usersCount', 'transactionsCount', 'payoutsCount', 'withdrawalsCount','propertiesCount'));
    }
}
