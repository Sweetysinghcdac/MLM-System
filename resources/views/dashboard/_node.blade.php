<div style="margin-left: 12px; border-left: 1px dashed #e5e7eb; padding-left:10px; margin-top:6px;">
    <div>
        <strong>{{ $node['user']->name }}</strong>
        <small class="text-xs text-gray-600">({{ $node['user']->referral_code }}) - points: {{ $node['user']->points }}</small>
    </div>

    @if(count($node['children']) > 0)
        @foreach($node['children'] as $child)
            @include('dashboard._node', ['node' => $child])
        @endforeach
    @endif
</div>
