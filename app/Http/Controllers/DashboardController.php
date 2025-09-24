<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $referrer = $user->referrer;
        $directReferrals = $user->referrals()->withCount('referrals')->get();
        $totalDirect = $directReferrals->count();
        $totalCommission = $user->total_commission_earned;
        $balance = $user->balance;

        return view('dashboard.index', compact('user', 'referrer', 'directReferrals', 'totalDirect', 'totalCommission', 'balance'));
    }

    // public function tree()
    // {
    //    $user = auth()->user();
    // $user->load('referrals.referrals.referrals'); // recursive eager load

    // $treeData = $this->buildTree($user);

    // return view('dashboard.tree', compact('treeData'));
    // }

    private function buildTree($user)
    {
        $node = [
            'user' => $user,
            'children' => []
        ];

        $user->load('referrals');

        foreach ($user->referrals as $child) {
            $node['children'][] = $this->buildTree($child);
        }

        return $node;
    }
    
    public function tree(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $initialDepth = 2; // You can adjust this value as needed

        $downline = $this->getDownlineRecursive($user, $initialDepth);

        // Treant.js configuration
        $treeConfigData = [
            'chart' => [
                'container' => "#mlm-tree",
                'connectors' => [
                    'type' => 'step'
                ],
                'node' => [
                    'collapsable' => true
                ],
                'rootOrientation' => 'NORTH', // Align from top to bottom
                'levelSeparation' => 30, // Adjust vertical spacing
                'siblingSeparation' => 30, // Adjust horizontal spacing
            ],
            'nodeStructure' => $downline,
        ];

        return view('dashboard.tree', [
            'treeConfigData' => $treeConfigData,
        ]);
    }

    /**
     * Recursively fetch a user's downline with a maximum depth limit.
     */
    protected function getDownlineRecursive(User $user, $maxDepth)
    {
        $node = [
            'text' => [
                'name' => $user->name,
                'title' => 'ID: ' . $user->id,
                'desc' => 'Points: ' . $user->points,
            ],
            'children' => [],
            'HTMLclass' => 'user-node',
        ];

        // Only load children if the current depth is less than the max depth
        if ($maxDepth > 0) {
            $user->load('referrals');

            if ($user->referrals->isNotEmpty()) {
                foreach ($user->referrals as $referral) {
                    $node['children'][] = $this->getDownlineRecursive($referral, $maxDepth - 1);
                }
            }
        }

        return $node;
    }
    
}

