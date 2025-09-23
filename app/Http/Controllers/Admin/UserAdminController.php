<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserAdminController extends Controller
{
      public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // Load referrals
        $tree = $this->buildReferralTree($user);
        return view('admin.users.show', compact('user', 'tree'));
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
}
