@extends('layouts.admin')

@section('title','Users')
@section('page-title','Users')

@section('content')
<div class="bg-white p-4 rounded shadow">
    <form method="GET" class="mb-4 flex gap-2">
        <input name="search" value="{{ request('search') }}" placeholder="Search name/email/referral" class="border p-2 rounded flex-1">
        <select name="has_referrals" class="border p-2 rounded">
            <option value="">All</option>
            <option value="1" @selected(request('has_referrals'))>Has referrals</option>
        </select>
        <button class="bg-blue-600 text-white px-3 py-2 rounded">Filter</button>
    </form>

    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="p-2 text-left">ID</th>
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Email</th>
                <th class="p-2 text-left">Refs</th>
                <th class="p-2 text-left">Balance</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="border-b">
                    <td class="p-2">{{ $user->id }}</td>
                    <td class="p-2">{{ $user->name }}</td>
                    <td class="p-2">{{ $user->email }}</td>
                    <td class="p-2">{{ $user->referrals_count }}</td>
                    <td class="p-2">${{ number_format($user->balance,2) }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600">View</a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="ml-2 text-gray-600">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection
