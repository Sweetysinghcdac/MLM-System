@extends('layouts.admin')

@section('title','Admin Dashboard')
@section('page-title','Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Total Users</h3>
        <p class="text-2xl font-bold">{{ number_format($totalUsers) }}</p>
        <p class="text-xs text-gray-400">New in 30d: {{ number_format($newUsers) }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Total Commissions Paid</h3>
        <p class="text-2xl font-bold">${{ number_format($totalCommissions,2) }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-sm text-gray-500">Pending Payouts</h3>
        <p class="text-2xl font-bold">${{ number_format($totalPendingPayouts,2) }}</p>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h4 class="font-semibold mb-3">Recent Registrations</h4>
        <ul class="space-y-2">
            @foreach($recentUsers as $u)
                <li class="text-sm">
                    <a href="{{ route('admin.users.show', $u->id) }}" class="text-blue-600">{{ $u->name }}</a>
                    <span class="text-gray-500"> — {{ $u->email }}</span>
                    <span class="text-xs text-gray-400 float-right">{{ $u->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h4 class="font-semibold mb-3">Recent Payout Requests</h4>
        <ul class="space-y-2 text-sm">
            @foreach($recentPayouts as $p)
                <li>
                    <strong>{{ $p->user->name }}</strong>
                    <span class="text-gray-500">requested ${{ number_format($p->amount,2) }}</span>
                    <span class="text-xs text-gray-400 float-right">{{ $p->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
