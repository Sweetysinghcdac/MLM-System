<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReferralCommission>
 */
class ReferralCommissionFactory extends Factory
{
    protected $model = \App\Models\ReferralCommission::class;

    public function definition(): array
    {
        $user = User::factory()->create();
        $referrer = User::factory()->create();
        $property = Property::factory()->create();

        return [
            'user_id' => $user->id,
            'referrer_id' => $referrer->id,
            'property_id' => $property->id,
            'level' => $this->faker->numberBetween(1, 3),
            'amount' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}
