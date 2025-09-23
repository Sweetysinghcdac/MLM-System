@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <main class="flex-1 p-6">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-800 p-3 rounded-lg shadow">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-2xl shadow-lg max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Simulate Transaction / Purchase</h2>

            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input type="number" name="amount" step="0.01" value="{{ old('amount', 100) }}" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                    <select name="mode" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="blockchain">Direct Blockchain (5% fee)</option>
                        <option value="manual">Manual / Off-chain (2% fee)</option>
                    </select>
                </div>

                <div>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">Process Transaction</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
