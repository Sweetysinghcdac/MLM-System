<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
       public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name','like','%'.$search.'%')
                  ->orWhere('email','like','%'.$search.'%')
                  ->orWhere('referral_code','like','%'.$search.'%');
            });
        }

        if ($request->filled('has_referrals')) {
            $query->whereHas('referrals');
        }

        $users = $query->withCount('referrals')->latest()->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

      public function show(User $user)
    {
        // 1. Eager load all necessary data in a single, efficient query.
        // We load referrals up to a certain depth (e.g., 3 levels) to start,
        // which avoids the N+1 problem for the initial view.
        $user->load([
            'referrer', 
            'commissions' => function($q) {
                // Eager load the related user for each commission record
                $q->latest()->with('user'); 
            },
            // Eager load referrals nested three levels deep
            'referrals.referrals.referrals' 
        ]);

        // 2. Prepare the data for the Treant.js tree view
        // The `formatTreeDataForTreant` method works on the data already loaded above.
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
            'nodeStructure' => $this->formatTreeDataForTreant($user),
        ];

        // 3. Prepare commissions for the view (e.g., paginated list)
        $commissions = $user->commissions()->latest()->with(['referrer', 'user'])->paginate(20);

        return view('admin.users.show', compact('user', 'commissions', 'treeConfigData'));
    }

    /**
     * Helper method to format eager-loaded data for Treant.js.
     * This method does not make new database queries.
     */
    private function formatTreeDataForTreant(User $user)
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

        // This recursive loop works on the data already in memory.
        if ($user->referrals->isNotEmpty()) {
            foreach ($user->referrals as $referral) {
                $node['children'][] = $this->formatTreeDataForTreant($referral);
            }
        }

        return $node;
    }

     public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users')->ignore($user->id)],
            'points' => 'nullable|integer|min:0',
            'balance' => 'nullable|numeric|min:0',
        ]);

        // Use transaction to update numeric fields
        DB::transaction(function () use ($user, $data) {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if (isset($data['points'])) {
                $user->points = (int)$data['points'];
            }
            if (isset($data['balance'])) {
                $user->balance = round($data['balance'],2);
            }
            $user->save();
        });

        return redirect()->route('admin.users.show', $user)->with('success', 'User updated.');
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
}
