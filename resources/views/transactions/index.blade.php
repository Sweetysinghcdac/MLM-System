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

        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Transactions</h2>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse text-left">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-3 text-gray-600 font-medium">ID</th>
                            <th class="p-3 text-gray-600 font-medium">Amount</th>
                            <th class="p-3 text-gray-600 font-medium">Mode</th>
                            <th class="p-3 text-gray-600 font-medium">Points</th>
                            <th class="p-3 text-gray-600 font-medium">Fee</th>
                            <th class="p-3 text-gray-600 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($txs as $tx)
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="p-3">{{ $tx->id }}</td>
                                <td class="p-3">${{ number_format($tx->amount,2) }}</td>
                                <td class="p-3">{{ ucfirst($tx->mode) }}</td>
                                <td class="p-3">{{ $tx->points_awarded }}</td>
                                <td class="p-3">${{ number_format($tx->platform_fee,2) }}</td>
                                <td class="p-3">{{ $tx->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-3 text-gray-400 italic">No transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $txs->links() }}
            </div>
        </div>
    </main>
</div>
@endsection
