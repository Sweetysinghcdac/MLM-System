@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="flex items-center justify-center h-16 border-b">
            <h1 class="text-xl font-bold text-indigo-600">MLM Dashboard</h1>
        </div>
        <nav class="mt-6">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9-9 9-9-9z" />
                </svg>
                Overview
            </a>
            <a href="{{ route('transactions.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('transactions.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3v6a3 3 0 006 0v-6c0-1.657-1.343-3-3-3z" />
                </svg>
                Transactions
            </a>
            <a href="{{ route('payouts.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('payouts.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Payouts
            </a>
            <a href="{{ route('tree.index') }}" 
               class="flex items-center px-6 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 {{ request()->routeIs('tree.*') ? 'bg-indigo-100 text-indigo-700 font-semibold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                MLM Tree
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-800">Dashboard</h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Hello, {{ Auth::user()->name }}</span>
                <img class="w-10 h-10 rounded-full border" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4F46E5&color=fff" alt="User Avatar">
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 p-6">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-sm font-medium text-gray-500">Direct Referrals</h3>
                    <p class="mt-2 text-2xl font-bold text-indigo-600">{{ Auth::user()->referrals()->count() }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Commission</h3>
                    <p class="mt-2 text-2xl font-bold text-green-600">${{ number_format(Auth::user()->commissions()->sum('amount'), 2) }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-sm font-medium text-gray-500">Balance</h3>
                    <p class="mt-2 text-2xl font-bold text-blue-600">${{ number_format(Auth::user()->balance, 2) }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Payouts</h3>
                    <p class="mt-2 text-2xl font-bold text-red-600">${{ number_format(Auth::user()->payouts()->where('status','approved')->sum('amount'), 2) }}</p>
                </div>
            </div>

            <!-- Latest Referrals Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Latest Direct Referrals</h3>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead>
                            <tr class="bg-gray-50 text-left text-sm font-medium text-gray-500">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Points</th>
                                <th class="px-4 py-2">Commission Earned</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse (Auth::user()->referrals()->latest()->take(5)->get() as $referral)
                                <tr>
                                    <td class="px-4 py-2">{{ $referral->name }}</td>
                                    <td class="px-4 py-2">{{ $referral->email }}</td>
                                    <td class="px-4 py-2">{{ $referral->points }}</td>
                                    <td class="px-4 py-2 text-green-600">
                                        ${{ number_format($referral->commissions()->where('referrer_id', Auth::id())->sum('amount'), 2) }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">No referrals yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
