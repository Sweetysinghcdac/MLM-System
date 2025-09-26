<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;
use App\Models\User;

class ReferralController extends Controller
{
   public function index()
    {
        $referrals = Commission::with(['user', 'referrer'])
            ->latest()
            ->paginate(10);

        return view('admin.referrals.index', compact('referrals'));
    }

      public function viewUserTree(Request $request)
    {
        $userId = $request->input('user_id');

        // Find the user or show an error if not found
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found. Please enter a valid user ID.');
        }

        // Get the entire downline of the user
        $downline = $this->getDownlineRecursive($user);

        $treeConfigData = [
            'chart' => [
                'container' => "#mlm-tree",
                'connectors' => [
                    'type' => 'step'
                ],
                'node' => [
                    'collapsable' => true
                ],
            ],
            'nodeStructure' => $downline,
        ];

        return view('admin.referrals.tree_view', [
            'treeConfigData' => $treeConfigData,
            'user' => $user,
        ]);
    }

    /**
     * Recursively fetch a user's downline for Treant.js.
     */
    protected function getDownlineRecursive(User $user)
    {
        $node = [
            'text' => [
                'name' => $user->name,
                'title' => 'ID: ' . $user->id,
                'desc' => 'Points: ' . $user->points,
            ],
            'children' => [],
            'HTMLclass' => 'user-node'
        ];

        $user->load('referrals');

        if ($user->referrals->isNotEmpty()) {
            foreach ($user->referrals as $referral) {
                $node['children'][] = $this->getDownlineRecursive($referral);
            }
        }

        return $node;
    }

    public function show(ReferralCommission $referral)
    {
        $referral->load(['user', 'referrer', 'property']);
        return view('admin.referrals.show', compact('referral'));
    }
}
