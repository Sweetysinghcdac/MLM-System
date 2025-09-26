@extends('layouts.admin')

@section('content')
<div class="flex h-screen bg-gray-100">
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