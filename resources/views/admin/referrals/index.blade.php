@extends('layouts.admin')
@section('title', 'Referrals')
@section('page-title', 'Referral Commissions')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">ID</th>
                <th class="p-2">User</th>
                <th class="p-2">Referrer</th>
                <th class="p-2">Property</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Level</th>
                <th class="p-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referrals as $referral)
                <tr class="border-b">
                    <td class="p-2">{{ $referral->id }}</td>
                    <td class="p-2">{{ $referral->user->name }}</td>
                    <td class="p-2">{{ $referral->referrer->name ?? 'N/A' }}</td>
                    <td class="p-2">{{ $referral->property->title ?? 'N/A' }}</td>
                    <td class="p-2">${{ number_format($referral->amount, 2) }}</td>
                    <td class="p-2">Level {{ $referral->level }}</td>
                    <td class="p-2">{{ $referral->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $referrals->links() }}</div>
</div>
@endsection
