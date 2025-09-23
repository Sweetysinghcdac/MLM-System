@extends('layouts.app')

@section('title', 'Withdraw Funds')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Withdraw Funds</h1>

    <div class="bg-white p-4 rounded shadow mb-6">
        <form action="{{ route('withdrawals.store') }}" method="POST" class="flex items-center space-x-4">
            @csrf
            <input type="number" name="amount" placeholder="Enter amount"
                   class="border p-2 rounded w-1/3" required min="100" step="1">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Request Withdrawal
            </button>
        </form>
    </div>

    <h2 class="text-lg font-semibold mb-3">My Withdrawal Requests</h2>
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Amount</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Admin Note</th>
                <th class="p-2 text-left">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
                <tr>
                    <td class="p-2">₹ {{ number_format($req->amount, 2) }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded
                            @if($req->status === 'pending') bg-yellow-200
                            @elseif($req->status === 'approved') bg-green-200
                            @else bg-red-200 @endif">
                            {{ ucfirst($req->status) }}
                        </span>
                    </td>
                    <td class="p-2">{{ $req->admin_note ?? '-' }}</td>
                    <td class="p-2">{{ $req->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-3 text-center text-gray-500">No withdrawal requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
