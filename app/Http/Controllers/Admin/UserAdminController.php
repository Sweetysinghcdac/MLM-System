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
        // Eager load related data
        $user->load(['referrer','referrals', 'commissions' => function($q){ $q->latest(); }]);

        // Build referral tree (recursive)
        $tree = $this->buildReferralTree($user);

        // Commission history (paginated)
        $commissions = $user->commissions()->with(['referrer','user'])->latest()->paginate(20);

        return view('admin.users.show', compact('user','tree','commissions'));
    }

    private function buildReferralTree(User $user)
    {
        $children = $user->referrals()->with('referrals')->get()->map(function ($child) {
            return [
                'user' => $child,
                'children' => $this->buildReferralTree($child),
            ];
        });

        return [
            'user' => $user,
            'children' => $children,
        ];
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
}
