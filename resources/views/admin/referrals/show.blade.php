@extends('layouts.admin')

@section('title', 'Referral Details')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Referral Commission Details</h2>

    <div class="bg-white p-4 rounded shadow">
        <p><strong>ID:</strong> {{ $referral->id }}</p>
        <p><strong>User:</strong> {{ $referral->user->name ?? 'N/A' }} ({{ $referral->user->email ?? '' }})</p>
        <p><strong>Referrer:</strong> {{ $referral->referrer->name ?? 'N/A' }} ({{ $referral->referrer->email ?? '' }})</p>
        <p><strong>Level:</strong> L{{ $referral->level }}</p>
        <p><strong>Amount:</strong> ₹{{ number_format($referral->amount, 2) }}</p>
        <p><strong>Date:</strong> {{ $referral->created_at->format('d M Y H:i') }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.referrals.index') }}" class="text-blue-600 hover:underline">← Back to Referrals</a>
    </div>
</div>
@endsection
