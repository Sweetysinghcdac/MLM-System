<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\Payout;
use App\Models\WithdrawalRequest;
use App\Models\ReferralCommission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create admin user
        $admin = User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // 2. Create 5 top-level users
        $topUsers = User::factory(5)->create();

        // 3. For each top-level user, create 2-3 referrals
        foreach ($topUsers as $user) {
            $referrals = User::factory(rand(2, 3))->create([
                'referrer_id' => $user->id
            ]);

            // 4. For each referral, create another level (level 2)
            foreach ($referrals as $child) {
                User::factory(rand(1, 2))->create([
                    'referrer_id' => $child->id
                ]);
            }
        }

        // 5. Create 10 properties
        $properties = Property::factory(10)->create();

        // 6. Assign some referral commissions for users
        $users = User::all();
        foreach ($users as $user) {
            if ($user->referrer_id) {
                ReferralCommission::factory()->create([
                    'user_id' => $user->id,
                    'referrer_id' => $user->referrer_id,
                    'property_id' => $properties->random()->id,
                    'level' => rand(1, 3),
                    'amount' => rand(10, 100),
                ]);
            }
        }

        // 7. Create 20 transactions
        Transaction::factory(20)->create([
            'user_id' => $users->random()->id,
        ]);

        // 8. Create 10 payout requests
        Payout::factory(10)->create([
            'user_id' => $users->random()->id,
        ]);

        // 9. Create 5 withdrawal requests
        WithdrawalRequest::factory(5)->create([
            'user_id' => $users->random()->id,
        ]);
    }
}
