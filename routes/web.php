<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController as RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\Admin\WithdrawalAdminController;


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

Route::middleware(['auth','is_admin'])->prefix('admin')->group(function () {
    Route::get('/withdrawals', [WithdrawalAdminController::class, 'index'])->name('admin.withdrawals.index');
    Route::put('/withdrawals/{withdrawal}', [WithdrawalAdminController::class, 'update'])->name('admin.withdrawals.update');
});

require __DIR__.'/auth.php';
