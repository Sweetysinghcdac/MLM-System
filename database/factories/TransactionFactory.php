<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = \App\Models\Transaction::class;

    public function definition(): array
    {
        $amount = $this->faker->randomFloat(2, 50, 1000);
        $mode = $this->faker->randomElement(['blockchain', 'manual']);
        $points = (int) ($amount * 10 / 100); // 10% points for simplicity
        $fee = $mode === 'blockchain' ? $amount * 0.05 : $amount * 0.02;

        return [
            'user_id' => \App\Models\User::factory(),
            'amount' => $amount,
            'mode' => $mode,
            'points_awarded' => $points,
            'platform_fee' => $fee,
        ];
    }
}
