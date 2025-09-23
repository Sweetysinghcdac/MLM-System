@extends('layouts.admin')
@section('title', 'Properties')
@section('page-title', 'All Properties')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">ID</th>
                <th class="p-2">Title</th>
                <th class="p-2">Owner</th>
                <th class="p-2">Created</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr class="border-b">
                    <td class="p-2">{{ $property->id }}</td>
                    <td class="p-2">{{ $property->title }}</td>
                    <td class="p-2">{{ $property->user?->name }}</td>
                    <td class="p-2">{{ $property->created_at->format('d M Y') }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.properties.show', $property) }}" class="text-blue-600">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $properties->links() }}</div>
</div>
@endsection
