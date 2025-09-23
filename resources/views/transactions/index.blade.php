@extends('layouts.app')

@section('content')
<div class="bg-white p-4 rounded shadow">
    <h2 class="font-semibold">Your Transactions</h2>

    <table class="w-full mt-4">
        <thead>
            <tr>
                <th class="p-2 text-left">ID</th>
                <th class="p-2 text-left">Amount</th>
                <th class="p-2 text-left">Mode</th>
                <th class="p-2 text-left">Points</th>
                <th class="p-2 text-left">Fee</th>
                <th class="p-2 text-left">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($txs as $tx)
                <tr>
                    <td class="p-2">{{ $tx->id }}</td>
                    <td class="p-2">{{ number_format($tx->amount,2) }}</td>
                    <td class="p-2">{{ $tx->mode }}</td>
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
</div>
@endsection
