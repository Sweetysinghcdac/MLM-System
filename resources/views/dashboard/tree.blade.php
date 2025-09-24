@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-100">
    @include('partials.sidebar')

    <div class="flex-1 overflow-x-auto p-4">
        <link rel="stylesheet" href="{{ asset('css/Treant.css') }}">
        <script src="{{ asset('js/raphael.min.js') }}"></script>
        <script src="{{ asset('js/Treant.min.js') }}"></script>

        <style>
            /* Basic styling for your tree nodes */
            .Treant > .node { padding: 5px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9; }
            .Treant > .node p.name { font-weight: bold; margin-bottom: 2px; }
            .Treant > .node p.title { font-size: 0.9em; color: #555; margin-bottom: 0px; }
            .Treant > .node p.desc { font-size: 0.8em; color: #777; margin-top: 2px; }

            /* Custom styling for user nodes (from HTMLclass in controller) */
            .Treant .user-node {
                background-color: #e6f7ff;
                border-color: #91d5ff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }

            /* Container for horizontal scrolling */
            .tree-container {
                width: 100%;
                overflow-x: auto;
            }
            .Treant {
                display: table; /* Make it take as much width as it needs */
                margin: 0 auto; /* Center the tree */
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