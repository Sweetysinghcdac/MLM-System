@extends('layouts.app')

@section('title', 'Referral Dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Referral Dashboard</h1>

    {{-- Wallet Balance --}}
    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
        <h2 class="text-lg font-semibold">Wallet Balance</h2>
        <p class="text-xl font-bold text-green-600">₹ {{ number_format(auth()->user()->wallet_balance, 2) }}</p>
    </div>

    {{-- Referral Commissions --}}
    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
        <h2 class="text-lg font-semibold mb-3">Referral Commissions</h2>
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 text-left">From User</th>
                    <th class="p-2 text-left">Level</th>
                    <th class="p-2 text-left">Property</th>
                    <th class="p-2 text-left">Amount</th>
                    <th class="p-2 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commissions as $commission)
                    <tr>
                        <td class="p-2">{{ $commission->user->name }}</td>
                        <td class="p-2">Level {{ $commission->level }}</td>
                        <td class="p-2">{{ optional($commission->property)->title ?? 'N/A' }}</td>
                        <td class="p-2">₹ {{ number_format($commission->amount, 2) }}</td>
                        <td class="p-2">{{ $commission->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">No commissions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Referral Tree --}}
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-lg font-semibold mb-3">My Downline</h2>
        <ul class="list-disc pl-6">
            @foreach($downline as $level => $users)
                <li class="mb-2">
                    <span class="font-bold">Level {{ $level }}:</span>
                    @forelse($users as $u)
                        {{ $u->name }} ({{ $u->email }})@if(!$loop->last), @endif
                    @empty
                        <span class="text-gray-500">No referrals at this level</span>
                    @endforelse
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
