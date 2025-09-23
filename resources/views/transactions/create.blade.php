@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-md">
    <h2 class="font-semibold mb-4">Simulate Transaction / Purchase</h2>

    <form method="POST" action="{{ route('transactions.store') }}">
        @csrf

        <div class="mb-3">
            <label class="block text-sm">Amount</label>
            <input type="number" name="amount" step="0.01" value="{{ old('amount', 100) }}" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-3">
            <label class="block text-sm">Mode</label>
            <select name="mode" class="w-full border p-2 rounded">
                <option value="blockchain">Direct Blockchain (5% fee)</option>
                <option value="manual">Manual / Off-chain (2% fee)</option>
            </select>
        </div>

        <div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Process Transaction</button>
        </div>
    </form>
</div>
@endsection
