{{-- resources/views/dashboard/_node_collapsible.blade.php --}}
@php
    $user = $node['user'];
@endphp

<ul class="mlm-ul">
    <li class="mlm-node" data-user-id="{{ $user->id }}">
        <div class="mlm-node-label" tabindex="0">
            <span class="mlm-toggle" role="button" aria-expanded="true">▾</span>
            <span class="mlm-name">{{ $user->name }}</span>
            <span class="mlm-meta">• <small class="mlm-points">Pts: {{ $user->points }}</small></span>
            <span class="mlm-meta">• <small class="mlm-direct">Referrals: {{ $user->referrals()->count() }}</small></span>
            <span class="mlm-code text-xs text-gray-500">({{ $user->referral_code }})</span>
        </div>

        @if(count($node['children']) > 0)
            <div class="mlm-children">
                @foreach($node['children'] as $child)
                    @include('dashboard._node_collapsible', ['node' => $child])
                @endforeach
            </div>
        @endif
    </li>
</ul>
