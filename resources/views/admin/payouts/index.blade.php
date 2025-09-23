@extends('layouts.admin')

@section('title', 'Payout Requests')
@section('page-title', 'Payout Requests')

@section('content')
<div class="bg-white p-4 rounded shadow">
    <form method="GET" class="mb-4 flex space-x-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by user" class="border p-2 rounded flex-1">
        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="pending" @selected(request('status')=='pending')>Pending</option>
            <option value="approved" @selected(request('status')=='approved')>Approved</option>
            <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Filter</button>
    </form>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-2">{{ session('success') }}</div>
    @endif

    <table class="w-full mt-2">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">User</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Status</th>
                <th class="p-2">Admin Note</th>
                <th class="p-2">Created</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payouts as $p)
                <tr class="border-b">
                    <td class="p-2">{{ $p->id }}</td>
                    <td class="p-2">{{ $p->user->name }}</td>
                    <td class="p-2">{{ number_format($p->amount,2) }}</td>
                    <td class="p-2">{{ ucfirst($p->status) }}</td>
                    <td class="p-2">{{ $p->admin_note }}</td>
                    <td class="p-2">{{ $p->created_at->format('Y-m-d H:i') }}</td>
                    <td class="p-2">
                        @if($p->status == 'pending')
                        <form method="POST" action="{{ route('admin.payouts.update', $p) }}">
                            @csrf
                            @method('PUT')
                            <select name="status" class="border p-1 rounded text-sm">
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                            <input type="text" name="admin_note" placeholder="Note" class="border p-1 rounded text-sm">
                            <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-sm mt-1">Update</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $payouts->links() }}
    </div>
</div>
@endsection
