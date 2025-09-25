<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commission;

class AdminCommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Commission::with(['user','referrer']);

        if ($search = $request->input('search')) {
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%');
            })->orWhereHas('referrer', function($q) use ($search) {
                $q->where('name','like','%'.$search.'%')->orWhere('email','like','%'.$search.'%');
            });
        }

        $commissions = $query->latest()->paginate(25)->withQueryString();

        return view('admin.commissions.index', compact('commissions'));
    }
}
