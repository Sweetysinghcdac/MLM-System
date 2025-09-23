<?php

namespace App\Services;

use App\Models\User;
use App\Models\ReferralCommission;

class ReferralService
{
    protected array $levels = [
        1 => 0.10, // 10% for direct referrer
        2 => 0.05, // 5% for second-level
        3 => 0.02, // 2% for third-level
    ];

    public function distributeCommission(User $buyer, float $transactionAmount, ?int $propertyId = null): void
    {
        $currentReferrer = $buyer->referrer;
        $level = 1;

        while ($currentReferrer && $level <= count($this->levels)) {
            $rate = $this->levels[$level];
            $commissionAmount = $transactionAmount * $rate;

            if ($commissionAmount > 0) {
                // Store commission
                ReferralCommission::create([
                    'user_id' => $buyer->id,
                    'referrer_id' => $currentReferrer->id,
                    'property_id' => $propertyId,
                    'level' => $level,
                    'amount' => $commissionAmount,
                ]);

                // Add to wallet
                $currentReferrer->increment('balance', $commissionAmount);
            }

            // Move to next upline
            $currentReferrer = $currentReferrer->referrer;
            $level++;
        }
    }
}
