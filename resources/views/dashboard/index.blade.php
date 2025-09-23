@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
        @include('partials.sidebar')

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
