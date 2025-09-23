@extends('layouts.app')

@section('title', 'Manage Withdrawals')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Manage Withdrawal Requests</h1>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">User</th>
                <th class="p-2">Amount</th>
                <th class="p-2">Status</th>
                <th class="p-2">Admin Note</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
                <tr>
                    <td class="p-2">{{ $req->user->name }} ({{ $req->user->email }})</td>
                    <td class="p-2">₹ {{ number_format($req->amount, 2) }}</td>
                    <td class="p-2">{{ ucfirst($req->status) }}</td>
                    <td class="p-2">{{ $req->admin_note ?? '-' }}</td>
                    <td class="p-2">
                        @if($req->status === 'pending')
                            <form action="{{ route('admin.withdrawals.update', $req) }}" method="POST" class="flex space-x-2">
                                @csrf @method('PUT')
                                <select name="status" class="border p-1 rounded">
                                    <option value="approved">Approve</option>
                                    <option value="rejected">Reject</option>
                                </select>
                                <input type="text" name="admin_note" placeholder="Note" class="border p-1 rounded">
                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Update</button>
                            </form>
                        @else
                            <span class="text-gray-500">No action</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-3 text-center text-gray-500">No withdrawal requests.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
