<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController as RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserAdminController;
// use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\TransactionAdminController;
use App\Http\Controllers\Admin\PayoutAdminController;
use App\Http\Controllers\Admin\ReferralCommissionController;
use App\Http\Controllers\Admin\WithdrawalAdminController as AdminWithdrawalController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ReferralController as AdminReferralController;






use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/tree', [DashboardController::class, 'tree'])->name('tree');
    Route::get('/api/tree/downline/{user_id}', [DashboardController::class, 'getDownline']);

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // Payouts
    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('/payouts/request', [PayoutController::class, 'requestForm'])->name('payouts.request');
    Route::post('/payouts/request', [PayoutController::class, 'requestStore'])->name('payouts.request.store');
    Route::get('/referrals/dashboard', [ReferralController::class, 'dashboard'])
        ->name('referrals.dashboard');


    Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');

});

Route::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function () {
     Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserAdminController::class, 'show'])->name('users.show');

    Route::get('/transactions', [TransactionAdminController::class, 'index'])->name('transactions.index');

    Route::get('/payouts', [PayoutAdminController::class, 'index'])->name('payouts.index');
    Route::put('/payouts/{payout}', [PayoutAdminController::class, 'update'])->name('payouts.update');

    Route::get('/withdrawals', [WithdrawalAdminController::class, 'index'])->name('withdrawals.index');
    Route::put('/withdrawals/{withdrawal}', [WithdrawalAdminController::class, 'update'])->name('withdrawals.update');
    //  Route::resource('properties', AdminPropertyController::class)->only(['index', 'show']);
    Route::resource('withdrawals', AdminWithdrawalController::class)->only(['index', 'show']);
    Route::resource('referrals', AdminReferralController::class)->only(['index', 'show']);
});


require __DIR__.'/auth.php';
