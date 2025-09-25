@extends('layouts.admin')

@section('title','User Details')
@section('page-title', $user->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Profile</h3>
        <p>{{ $user->email }}</p>
        <p>Points: {{ $user->points }}</p>
        <p>Balance: ${{ number_format($user->balance,2) }}</p>
        <p>Referral Code: {{ $user->referral_code }}</p>
        <p>Referrer: {{ $user->referrer?->name ?? 'None' }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow lg:col-span-2">
        <h3 class="font-semibold mb-2">Direct Referrals</h3>
        <ul class="space-y-2">
            @foreach($user->referrals as $r)
                <li>
                    <a href="{{ route('admin.users.show', $r) }}" class="text-blue-600">{{ $r->name }}</a>
                    <span class="text-gray-500"> ({{ $r->email }})</span>
                </li>
            @endforeach
        </ul>

        <hr class="my-4">

        <h3 class="font-semibold mb-2">Commission History</h3>
        @foreach($commissions as $c)
            <div class="py-2 border-b">
                <div class="flex justify-between">
                    <div>
                        <strong>From: {{ $c->user->name }}</strong> (Level {{ $c->level }})
                    </div>
                    <div>${{ number_format($c->amount,2) }}</div>
                </div>
                <div class="text-xs text-gray-400">{{ $c->created_at->diffForHumans() }}</div>
            </div>
        @endforeach

        <div class="mt-4">{{ $commissions->links() }}</div>

        <hr class="my-4">

        <h3 class="font-semibold mb-2">Referral Tree</h3>
        <div class="text-sm">
            @include('admin.users._node', ['node' => $tree])
        </div>
    </div>
</div>
@endsection
