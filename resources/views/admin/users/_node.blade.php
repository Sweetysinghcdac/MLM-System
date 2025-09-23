@php $user = $node['user']; @endphp

<div class="ml-4 border-l pl-4 mt-2">
    <div>
        <strong>{{ $user->name }}</strong>
        <small class="text-xs text-gray-500">({{ $user->referral_code }}) - Pts: {{ $user->points }} | Refs: {{ $user->referrals()->count() }}</small>
    </div>

    @if(count($node['children']) > 0)
        @foreach($node['children'] as $child)
            @include('admin.users._node', ['node' => $child])
        @endforeach
    @endif
</div>
