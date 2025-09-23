<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckReferralCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('ref') && !empty($request->get('ref'))) {
            $ref = $request->get('ref');
            if (User::where('referral_code', $ref)->exists()) {
                // keep it in session for registration convenience
                $request->session()->put('referral_code', $ref);
            }
        }
        return $next($request);
    }
}
