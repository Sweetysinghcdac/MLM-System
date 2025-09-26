@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-2">View User Referral Tree</h3>
        <form action="{{ route('admin.tree.view') }}" method="GET" class="flex items-center space-x-4">
            <input type="text" name="user_id" placeholder="Enter User ID" class="border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                View Tree
            </button>
        </form>
    </div>

    </div>
@endsection