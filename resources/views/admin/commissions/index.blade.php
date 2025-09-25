@extends('layouts.admin')
@section('title','Commissions')
@section('page-title','Commissions')

@section('content')
<div class="bg-white p-4 rounded shadow">
    <form method="GET" class="mb-4 flex gap-2">
        <input name="search" value="{{ request('search') }}" placeholder="Search user/referrer" class="border p-2 rounded flex-1">
        <button class="bg-blue-600 text-white px-3 py-2 rounded">Search</button>
    </form>

    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Earner</th>
                <th class="p-2">Referred</th>
                <th class="p-2">Level</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Date</th>
            </tr>
        </thead>
        <tbody >
            @foreach($commissions as $c)
                <tr class="border-b">
                    <td class="p-2">{{ $c->id }}</td>
                    <td class="p-2">{{ $c->referrer->name ?? 'N/A' }}</td>
                    <td class="p-2">{{ $c->user->name ?? 'N/A' }}</td>
                    <td class="p-2">L{{ $c->level }}</td>
                    <td class="p-2">${{ number_format($c->amount,2) }}</td>
                    <td class="p-2">{{ $c->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $commissions->links() }}</div>
</div>
@endsection
