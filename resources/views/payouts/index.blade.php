@extends('layouts.app')

@section('content')
<div class="bg-white p-4 rounded shadow">
    <h2 class="font-semibold">Payouts</h2>

    <div class="mt-2 mb-4">
        <p>Your balance: <strong>{{ number_format($user->balance,2) }}</strong></p>
        <a href="{{ route('payouts.request') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Request Payout</a>
    </div>

    <h3 class="font-medium mt-4">Your payout requests</h3>
    <table class="w-full mt-2">
        <thead>
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Status</th>
                <th class="p-2">Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payouts as $p)
                <tr>
                    <td class="p-2">{{ $p->id }}</td>
                    <td class="p-2">{{ number_format($p->amount,2) }}</td>
                    <td class="p-2">{{ ucfirst($p->status) }}</td>
                    <td class="p-2">{{ $p->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr><td class="p-2" colspan="4">No payout requests yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
