<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Commission;
class ReferralController extends Controller
{
   public function index()
{
    $users = User::with(['referrals', 'commissions'])->get();

    $treeConfigs = [];

    foreach ($users as $user) {
        $treeConfigs[$user->id] = $this->buildTreeConfig($user);
    }

    return view('admin.referrals.index', compact('treeConfigs'));
}

protected function buildTreeConfig(User $user)
{
    $rootNode = [
        'text' => [
            'name' => $user->name,
            'title' => 'Balance: ₹' . number_format($user->balance, 2),
            'desc' => 'Total Earned: ₹' . number_format($user->commissions->sum('amount'), 2),
        ],
        'HTMLclass' => 'user-node',
    ];

    $children = $user->referrals->map(function ($ref) {
        return [
            'text' => [
                'name' => $ref->name,
                'title' => 'Balance: ₹' . number_format($ref->balance, 2),
                'desc' => 'Total Earned: ₹' . number_format($ref->commissions->sum('amount'), 2),
            ]
        ];
    })->toArray();

    return [
        'chart' => [
            'container' => '', // filled dynamically in Blade
            'connectors' => ['type' => 'step'],
            'node' => ['HTMLclass' => 'nodeExample1'],
        ],
        'nodeStructure' => array_merge($rootNode, [
            'children' => $children,
        ]),
    ];
}


    public function show(ReferralCommission $referral)
    {
        $referral->load(['user', 'referrer', 'property']);
        return view('admin.referrals.show', compact('referral'));
    }
}
