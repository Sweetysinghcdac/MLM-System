@extends('layouts.app')

@section('title', 'Referral Tree')

@section('content')
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Referral Tree</h1>

        <div class="bg-white p-6 rounded-2xl shadow-lg overflow-auto">
            <div class="tree-legend mb-6 text-sm text-gray-500">
                Click a node to expand/collapse. 
                <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800 font-semibold">Green = points</span>, 
                <span class="inline-block px-2 py-1 rounded bg-blue-100 text-blue-800 font-semibold">Blue = direct referrals</span>
            </div>

            <div class="mlm-tree-horizontal">
                @include('dashboard._node_horizontal', ['node' => $tree])
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/tree.js') }}"></script>
@endpush
