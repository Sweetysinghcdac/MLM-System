<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\User;
use App\Services\ReferralService;
use Illuminate\Http\Request;

class PropertyTransactionController extends Controller
{
    protected ReferralService $referralService;

    public function __construct(ReferralService $referralService)
    {
        $this->referralService = $referralService;
    }

    public function purchase(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $buyer = auth()->user();
        $amount = $property->price;

        // Distribute multi-level referral commissions
        $this->referralService->distributeCommission($buyer, $amount, $property->id);

        return redirect()->back()->with('success', 'Property purchased & referral commissions distributed!');
    }
}
