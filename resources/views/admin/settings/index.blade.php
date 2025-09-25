@extends('layouts.admin')

@section('page-title', 'System Settings')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">System Settings</h2>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-800 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Blockchain Fee (%)</label>
                <input type="number" step="0.01" name="commission_rate_blockchain" value="{{ $settings['commission_rate_blockchain'] ?? 0.05 }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Manual Fee (%)</label>
                <input type="number" step="0.01" name="commission_rate_manual" value="{{ $settings['commission_rate_manual'] ?? 0.02 }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Payout Threshold</label>
                <input type="number" step="0.01" name="payout_threshold" value="{{ $settings['payout_threshold'] ?? 100 }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label>MLM Level 1 Rate (%)</label>
                <input type="number" step="0.01" name="mlm_level_1_rate" value="{{ $settings['mlm_level_1_rate'] ?? 0.10 }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>MLM Level 2 Rate (%)</label>
                <input type="number" step="0.01" name="mlm_level_2_rate" value="{{ $settings['mlm_level_2_rate'] ?? 0.05 }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>MLM Level 3 Rate (%)</label>
                <input type="number" step="0.01" name="mlm_level_3_rate" value="{{ $settings['mlm_level_3_rate'] ?? 0.02 }}" class="w-full border rounded p-2">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save Settings</button>
        </div>
    </form>
</div>
@endsection
