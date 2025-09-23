@php
    $user = $node['user'];
@endphp

<div class="mlm-node-horizontal">
    <div class="mlm-node-label" onclick="toggleChildren(this)">
        <span class="mlm-toggle">▾</span>
        <div><strong>{{ $user->name }}</strong></div>
        <div class="text-xs text-gray-500">({{ $user->referral_code }})</div>
        <div class="text-green-600 text-xs font-semibold">Pts: {{ $user->points }}</div>
        <div class="text-blue-600 text-xs font-semibold">Refs: {{ $user->referrals()->count() }}</div>
    </div>

    @if(count($node['children']) > 0)
        <div class="mlm-children-horizontal">
            @foreach($node['children'] as $child)
                @include('dashboard._node_horizontal', ['node' => $child])
            @endforeach
        </div>
    @endif
</div>
