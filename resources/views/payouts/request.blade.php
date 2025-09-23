@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">

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
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Request Payout</h2>

            <p class="text-gray-700 mb-4">Available balance: <span class="font-semibold text-gray-900">${{ number_format($user->balance,2) }}</span></p>

            <form method="POST" action="{{ route('payouts.request.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input type="number" name="amount" step="0.01" max="{{ $user->balance }}" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    @error('amount')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">Submit Request</button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
