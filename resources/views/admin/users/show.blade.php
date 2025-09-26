@extends('layouts.admin')

@section('title','User Details')
@section('page-title', $user->name)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="font-semibold">Profile</h3>
        <p>{{ $user->email }}</p>
        <p>Points: {{ $user->points }}</p>
        <p>Balance: ${{ number_format($user->balance,2) }}</p>
        <p>Referral Code: {{ $user->referral_code }}</p>
        <p>Referrer: {{ $user->referrer?->name ?? 'None' }}</p>
    </div>

    <div class="bg-white p-4 rounded shadow lg:col-span-2">
        <h3 class="font-semibold mb-2">Direct Referrals</h3>
        <ul class="space-y-2">
            @foreach($user->referrals as $r)
                <li>
                    {{-- THIS LINE IS CORRECTED --}}
                    <a href="{{ route('admin.tree.view', ['user_id' => $r->id]) }}" class="text-blue-600 hover:underline">{{ $r->name }}</a>
                    <span class="text-gray-500"> ({{ $r->email }})</span>
                </li>
            @endforeach
        </ul>

        <hr class="my-4">

        <h3 class="font-semibold mb-2">Commission History</h3>
        @foreach($commissions as $c)
            <div class="py-2 border-b">
                <div class="flex justify-between">
                    <div>
                        <strong>From: {{ $c->user->name }}</strong> (Level {{ $c->level }})
                    </div>
                    <div>${{ number_format($c->amount,2) }}</div>
                </div>
                <div class="text-xs text-gray-400">{{ $c->created_at->diffForHumans() }}</div>
            </div>
        @endforeach

        <div class="mt-4">{{ $commissions->links() }}</div>

        <hr class="my-4">

        <h3 class="font-semibold mb-2">Referral Tree</h3>
        <div class="flex-1 overflow-x-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Referral Tree for: {{ $user->name }} (ID: {{ $user->id }})</h2>

            <link rel="stylesheet" href="{{ asset('css/Treant.css') }}">
            <script src="{{ asset('js/raphael.min.js') }}"></script>
            <script src="{{ asset('js/Treant.min.js') }}"></script>

            <style>
                .Treant > .node { padding: 5px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; }
                .Treant > .node p.name { font-weight: bold; margin-bottom: 2px; }
                .Treant > .node p.title { font-size: 0.9em; color: #555; margin-bottom: 0px; }
                .Treant > .node p.desc { font-size: 0.8em; color: #777; margin-top: 2px; }
                .Treant .user-node {
                    background-color: #e6f7ff;
                    border-color: #91d5ff;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                .tree-container {
                    width: 100%;
                    overflow-x: auto;
                }
                .Treant {
                    display: table;
                    margin: 0 auto;
                }
            </style>

            <div class="tree-container">
                <div id="mlm-tree" class="Treant"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const treeConfig = @json($treeConfigData);

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Treant !== 'undefined') {
            new Treant(treeConfig);
        } else {
            console.error("Treant.js is not loaded.");
        }
    });
</script>
@endsection