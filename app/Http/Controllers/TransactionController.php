<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;

class TransactionController extends Controller
{
     protected $svc;

    public function __construct(TransactionService $svc)
    {
        $this->svc = $svc;
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(StoreTransactionRequest  $request)
    {
        $validated = $request->validated();
        
        $user = Auth::user();
        $tx = $this->svc->process($user, (float)$request->amount, $request->mode);

        return redirect()->route('dashboard')->with('success', 'Transaction processed.');
    }

    public function index()
    {
        $txs = Auth::user()->transactions()->latest()->paginate(15);
        return view('transactions.index', compact('txs'));
    }
}
