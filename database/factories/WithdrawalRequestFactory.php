<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WithdrawalRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WithdrawalRequest>
 */
class WithdrawalRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   protected $model = WithdrawalRequest::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // create a new user by default
           'amount' => $this->faker->randomFloat(2, 50, 500),
            'status' => 'pending',
            'admin_note' => null,
        ];
    }
}
