@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-md">
    <h2 class="font-semibold mb-4">Request Payout</h2>

    <p class="mb-3">Available balance: <strong>{{ number_format($user->balance,2) }}</strong></p>

    <form method="POST" action="{{ route('payouts.request.store') }}">
        @csrf

        <div class="mb-3">
            <label class="block text-sm">Amount</label>
            <input type="number" name="amount" step="0.01" max="{{ $user->balance }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit Request</button>
        </div>
    </form>
</div>
@endsection
