@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-lg flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-500">
            <span class="text-white">My Dashboard</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7v6h6v6h6v-6h-6z"></path>
                </svg>
                Home
            </a>

            <a href="{{ route('transactions.create') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 4v16m8-8H4"></path>
                </svg>
                Create Transaction
            </a>

            <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 10h18M3 6h18M3 14h18M3 18h18"></path>
                </svg>
                Transactions
            </a>

            <a href="{{ route('payouts.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 8c-3.314 0-6 1.79-6 4s2.686 4 6 4 6-1.79 6-4-2.686-4-6-4z"></path>
                    <path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"></path>
                </svg>
                Payouts
            </a>

            <a href="{{ route('tree') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2v20m-6-6h12"></path>
                </svg>
                Referral Tree
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border-l-4 border-blue-500">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Your Info</h2>
                <p class="text-gray-600 mb-2">Name: <span class="font-medium text-gray-900">{{ $user->name }}</span></p>
                <p class="text-gray-600 mb-2">Email: <span class="font-medium text-gray-900">{{ $user->email }}</span></p>
                <p class="text-gray-600">Referral code: <span class="font-medium text-gray-900">{{ $user->referral_code }}</span></p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border-l-4 border-green-500">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Referrer</h2>
                @if($referrer)
                    <p class="text-gray-700 mb-1">{{ $referrer->name }} <span class="text-gray-500">({{ $referrer->email }})</span></p>
                    <p class="text-gray-600">Code: <span class="font-medium text-gray-900">{{ $referrer->referral_code }}</span></p>
                @else
                    <p class="text-gray-400 italic">No referrer</p>
                @endif
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border-l-4 border-yellow-500">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Stats</h2>
                <p class="text-gray-600 mb-2">Direct referrals: <span class="font-medium text-gray-900">{{ $totalDirect }}</span></p>
                <p class="text-gray-600 mb-2">Points: <span class="font-medium text-gray-900">{{ $user->points }}</span></p>
                <p class="text-gray-600 mb-2">Balance: <span class="font-medium text-gray-900">${{ number_format($balance,2) }}</span></p>
                <p class="text-gray-600">Total commission earned: <span class="font-medium text-gray-900">${{ number_format($totalCommission,2) }}</span></p>
            </div>
        </div>

        <!-- Direct Referrals Table -->
        <div class="bg-white p-6 rounded-2xl shadow-lg overflow-x-auto mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Direct Referrals</h3>
            <table class="w-full table-auto border-collapse text-left">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-3 text-gray-600 font-medium">Name</th>
                        <th class="p-3 text-gray-600 font-medium">Email</th>
                        <th class="p-3 text-gray-600 font-medium">Points</th>
                        <th class="p-3 text-gray-600 font-medium">Direct Referrals</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($directReferrals as $r)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="p-3">{{ $r->name }}</td>
                            <td class="p-3">{{ $r->email }}</td>
                            <td class="p-3">{{ $r->points }}</td>
                            <td class="p-3">{{ $r->referrals_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-gray-400 italic">No direct referrals</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
