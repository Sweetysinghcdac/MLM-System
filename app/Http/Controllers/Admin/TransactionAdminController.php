<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionAdminController extends Controller
{
      public function index()
    {
        $txs = Transaction::with('user')->latest()->paginate(20);
        return view('admin.transactions.index', compact('txs'));
    }
}
