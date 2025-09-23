<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Commission;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    // Multi-level percentages
    const REFERRAL_PERCENTAGES = [
        1 => 0.10, // 10% L1
        2 => 0.05, // 5%  L2
        3 => 0.02, // 2%  L3
    ];

    const BLOCKCHAIN_FEE = 0.05;
    const MANUAL_FEE = 0.02;

    /**
     * Process transaction and distribute commissions up to 3 levels.
     *
     * @param \App\Models\User $user
     * @param float $amount
     * @param string $mode 'blockchain'|'manual'
     * @return Transaction
     */
    public function process($user, float $amount, string $mode)
    {
        return DB::transaction(function () use ($user, $amount, $mode) {
            $feeRate = $mode === 'blockchain' ? self::BLOCKCHAIN_FEE : self::MANUAL_FEE;
            $platformFee = round($amount * $feeRate, 2);

            // Points awarded (simple): 1 point per currency unit (floor)
            $points = (int) floor($amount);

            $tx = Transaction::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'mode' => $mode,
                'platform_fee' => $platformFee,
                'points_awarded' => $points,
            ]);

            // Add points to buyer
            $user->increment('points', $points);

            // Distribute commissions up the upline
            $current = $user->referrer()->lockForUpdate()->first();
            $level = 1;

            while ($current && $level <= count(self::REFERRAL_PERCENTAGES)) {
                $rate = self::REFERRAL_PERCENTAGES[$level];
                // Commission: using points -> treat 1 point = 1 currency unit
                $commissionAmount = round($points * $rate, 2);

                if ($commissionAmount > 0) {
                    Commission::create([
                        'referrer_id' => $current->id,
                        'referred_user_id' => $user->id,
                        'transaction_id' => $tx->id,
                        'level' => $level,
                        'amount' => $commissionAmount,
                    ]);

                    // add to referrer's balance
                    $current->increment('balance', $commissionAmount);
                    $current->increment('total_commission_earned', $commissionAmount);
                }

                $current = $current->referrer()->lockForUpdate()->first();
                $level++;
            }

            return $tx;
        });
    }
}
