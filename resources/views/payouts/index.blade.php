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

        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Payouts</h2>
            <a href="{{ route('payouts.request') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 transition">Request Payout</a>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg mb-6">
            <p class="text-gray-700">Your balance: <span class="font-semibold text-gray-900">${{ number_format($user->balance,2) }}</span></p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg overflow-x-auto">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Your Payout Requests</h3>
            <table class="w-full table-auto border-collapse text-left">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-3 text-gray-600 font-medium">ID</th>
                        <th class="p-3 text-gray-600 font-medium">Amount</th>
                        <th class="p-3 text-gray-600 font-medium">Status</th>
                        <th class="p-3 text-gray-600 font-medium">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payouts as $p)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="p-3">{{ $p->id }}</td>
                            <td class="p-3">${{ number_format($p->amount,2) }}</td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-lg 
                                    @if($p->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($p->status === 'approved') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="p-3">{{ $p->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-gray-400 italic">No payout requests yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>4
</div>
@endsection
