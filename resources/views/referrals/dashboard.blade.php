@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Referral Dashboard</h1>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-lg font-semibold">Wallet Balance</h2>
        <p class="text-xl font-bold text-green-600">₹ {{ number_format(auth()->user()->balance, 2) }}</p>
        <p class="text-sm text-gray-600">Total commission earned: ₹ {{ number_format(auth()->user()->total_commission_earned, 2) }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-3">Commission History</h2>
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">From</th>
                    <th class="p-2 text-left">Level</th>
                    <th class="p-2 text-left">Amount</th>
                    <th class="p-2 text-left">Txn</th>
                    <th class="p-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commissions as $c)
                    <tr>
                        <td class="p-2">{{ $c->referredUser->name ?? '—' }}</td>
                        <td class="p-2">L{{ $c->level }}</td>
                        <td class="p-2">₹ {{ number_format($c->amount, 2) }}</td>
                        <td class="p-2">{{ optional($c->transaction)->id ?? '—' }}</td>
                        <td class="p-2">{{ $c->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-3 text-center text-gray-500">No commissions yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-lg font-semibold mb-3">Downline (up to 3 levels)</h2>
        <ul>
            @foreach($downline as $level => $users)
                <li class="mb-2">
                    <strong>Level {{ $level }}:</strong>
                    @if($users->isEmpty())
                        <span class="text-gray-500">No referrals</span>
                    @else
                        @foreach($users as $u)
                            <span>{{ $u->name }}</span>@if(!$loop->last), @endif
                        @endforeach
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
