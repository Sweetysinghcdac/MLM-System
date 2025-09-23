@extends('layouts.admin')

@section('title', 'Referral Tree')
@section('page-title', 'Referral Tree: ' . $user->name)

@section('content')
<div class="bg-white p-4 rounded shadow">
    <h2 class="text-lg font-semibold mb-4">{{ $user->name }}'s Referral Tree</h2>

    <div id="referral-tree" class="mlm-tree">
        @include('admin.users._node', ['node' => $tree])
    </div>
</div>
@endsection
