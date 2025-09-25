@extends('layouts.admin')

@section('title', 'Referrals')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Referral Commissions</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">User</th>
                    <th class="px-4 py-2 text-left">Referrer</th>
                    <th class="px-4 py-2 text-left">Level</th>
                    <th class="px-4 py-2 text-left">Amount</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($referrals as $referral)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $referral->id }}</td>
                        <td class="px-4 py-2">
                            {{ $referral->user->name ?? 'N/A' }} <br>
                            <small>{{ $referral->user->email ?? '' }}</small>
                        </td>
                        <td class="px-4 py-2">
                            {{ $referral->referrer->name ?? 'N/A' }} <br>
                            <small>{{ $referral->referrer->email ?? '' }}</small>
                        </td>
                        <td class="px-4 py-2">L{{ $referral->level }}</td>
                        <td class="px-4 py-2">₹{{ number_format($referral->amount, 2) }}</td>
                        <td class="px-4 py-2">{{ $referral->created_at->format('d M Y H:i') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.referrals.show', $referral->id) }}" 
                               class="text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500">No referrals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $referrals->links() }}
    </div>
</div>
@endsection
