<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ReferralCommission;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @extends Factory<\App\Models\ReferralCommission>
 */
class ReferralCommissionFactory extends Factory
{
    protected $model = ReferralCommission::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'referrer_id' => User::factory(),
            'property_id' => Property::factory(),
            'level' => $this->faker->numberBetween(1, 3),
            'amount' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
