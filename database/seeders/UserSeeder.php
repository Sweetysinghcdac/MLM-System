<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'referral_code' => User::generateReferralCode(),
        ]);
        $level1 = User::create([
            'name' => 'Referrer L1',
            'email' => 'ref1@example.com',
            'password' => Hash::make('password'),
            'balance' => 0,
        ]);

        $level2 = User::create([
            'name' => 'Referrer L2',
            'email' => 'ref2@example.com',
            'password' => Hash::make('password'),
            'balance' => 0,
            'referrer_id' => $level1->id,
        ]);

        $level3 = User::create([
            'name' => 'Referrer L3',
            'email' => 'ref3@example.com',
            'password' => Hash::make('password'),
            'balance' => 0,
            'referrer_id' => $level2->id,
        ]);

        User::create([
            'name' => 'Buyer',
            'email' => 'buyer@example.com',
            'password' => Hash::make('password'),
            'balance' => 0,
            'referrer_id' => $level3->id,
        ]);
    }
}
