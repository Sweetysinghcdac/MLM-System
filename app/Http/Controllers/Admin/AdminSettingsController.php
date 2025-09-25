<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
    {
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $rules = [
            'commission_rate_blockchain' => 'required|numeric|min:0|max:1',
            'commission_rate_manual' => 'required|numeric|min:0|max:1',
            'payout_threshold' => 'required|numeric|min:0',
            'mlm_level_1_rate' => 'required|numeric|min:0|max:1',
            'mlm_level_2_rate' => 'required|numeric|min:0|max:1',
            'mlm_level_3_rate' => 'required|numeric|min:0|max:1',
        ];
        $validated = $request->validate($rules);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Settings updated successfully!');
    }

}
