@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-3 gap-6">
        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Total Users</h2>
            <p class="text-2xl mt-2">{{ $usersCount }}</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Total Properties</h2>
            <p class="text-2xl mt-2"></p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Transactions</h2>
            <p class="text-2xl mt-2">{{ $transactionsCount }}</p>
        </div>
    </div>
@endsection
