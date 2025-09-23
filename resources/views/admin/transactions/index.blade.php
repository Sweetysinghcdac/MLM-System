@extends('layouts.admin')

@section('title', 'Transactions')
@section('page-title', 'All Transactions')

@section('content')
<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">ID</th>
            <th class="p-2">User</th>
            <th class="p-2">Amount</th>
            <th class="p-2">Mode</th>
            <th class="p-2">Points</th>
            <th class="p-2">Fee</th>
            <th class="p-2">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($txs as $tx)
        <tr class="border-b">
            <td class="p-2">{{ $tx->id }}</td>
            <td class="p-2">{{ $tx->user->name }}</td>
            <td class="p-2">{{ number_format($tx->amount,2) }}</td>
            <td class="p-2">{{ ucfirst($tx->mode) }}</td>
            <td class="p-2">{{ $tx->points_awarded }}</td>
            <td class="p-2">{{ number_format($tx->platform_fee,2) }}</td>
            <td class="p-2">{{ $tx->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $txs->links() }}
</div>
@endsection
