@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', 'Users List')

@section('content')
<table class="w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-2">ID</th>
            <th class="p-2">Name</th>
            <th class="p-2">Email</th>
            <th class="p-2">Referrals</th>
            <th class="p-2">Balance</th>
            <th class="p-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="border-b">
            <td class="p-2">{{ $user->id }}</td>
            <td class="p-2">{{ $user->name }}</td>
            <td class="p-2">{{ $user->email }}</td>
            <td class="p-2">{{ $user->referrals()->count() }}</td>
            <td class="p-2">{{ number_format($user->balance,2) }}</td>
            <td class="p-2">
                <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600">View Tree</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
