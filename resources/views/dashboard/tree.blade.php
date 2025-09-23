{{-- resources/views/dashboard/tree.blade.php --}}
@extends('layouts.dashboard')

@section('title', 'Referral Tree')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Referral Tree</h1>
    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <div class="tree-legend mb-6 text-sm text-gray-500">
            Click a node to expand/collapse. 
            <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800 font-semibold">Green = points</span>, 
            <span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-800 font-semibold">Blue = direct referrals</span>
        </div>

        <div id="mlm-tree-root" class="mlm-tree space-y-4">
            @include('dashboard._node_collapsible', ['node' => $tree])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/tree.js') }}"></script>
@endpush
