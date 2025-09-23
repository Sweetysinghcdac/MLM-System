<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Commission;
use App\Models\WithdrawalRequest;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\VerifyCsrfToken;

class MLMFeatureTest extends TestCase
{
      use RefreshDatabase;

    // protected function setUp(): void
    // {
    //     parent::setUp();
    //     $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    //     // Ensure factories exist. If not, create minimal users manually here.
    // }

    /** @test */
    public function multi_level_commission_distribution_works()
    {
        // Create an upline: level1 (grandparent) -> level2 (parent) -> level3 (direct referrer) -> buyer
        $level1 = User::factory()->create(['name' => 'Level1', 'email' => 'l1@example.com']);
        $level2 = User::factory()->create(['name' => 'Level2', 'email' => 'l2@example.com', 'referrer_id' => $level1->id]);
        $level3 = User::factory()->create(['name' => 'Level3', 'email' => 'l3@example.com', 'referrer_id' => $level2->id]);
        $buyer  = User::factory()->create(['name' => 'Buyer', 'email' => 'buyer@example.com', 'referrer_id' => $level3->id]);

        // Process transaction using the service
        $svc = app(TransactionService::class);
        $tx = $svc->process($buyer, 100.00, 'manual'); // 100 amount, manual (2% platform fee)

        // Points = floor(100) = 100
        $this->assertDatabaseHas('transactions', [
            'id' => $tx->id,
            'user_id' => $buyer->id,
            'amount' => '100.00',
            'points_awarded' => 100,
        ]);

        // Commissions expected:
        // L1 (level 3 in our naming) => level=3 receives 2% of 100 => 2.00
        // L2 => level=2 receives 5% of 100 => 5.00
        // L3 (direct referrer) => level=1 receives 10% of 100 => 10.00

        // Check commission rows and balances
        $this->assertDatabaseHas('commissions', [
            'referrer_id' => $level3->id,
            'referred_user_id' => $buyer->id,
            'transaction_id' => $tx->id,
            'level' => 1,
            'amount' => '10.00',
        ]);

        $this->assertDatabaseHas('commissions', [
            'referrer_id' => $level2->id,
            'referred_user_id' => $buyer->id,
            'transaction_id' => $tx->id,
            'level' => 2,
            'amount' => '5.00',
        ]);

        $this->assertDatabaseHas('commissions', [
            'referrer_id' => $level1->id,
            'referred_user_id' => $buyer->id,
            'transaction_id' => $tx->id,
            'level' => 3,
            'amount' => '2.00',
        ]);

        // Check balances updated
        $this->assertEquals(10.00, $level3->fresh()->balance);
        $this->assertEquals(5.00, $level2->fresh()->balance);
        $this->assertEquals(2.00, $level1->fresh()->balance);
    }

    /** @test */
    public function platform_fee_is_correct_for_blockchain_and_manual_modes()
    {
        $buyer = User::factory()->create();

        $svc = app(TransactionService::class);

        // Blockchain: 5%
        $tx1 = $svc->process($buyer, 200.00, 'blockchain');
        $this->assertDatabaseHas('transactions', [
            'id' => $tx1->id,
            'platform_fee' => '10.00' // 5% of 200
        ]);

        // Manual: 2%
        $tx2 = $svc->process($buyer, 200.00, 'manual');
        $this->assertDatabaseHas('transactions', [
            'id' => $tx2->id,
            'platform_fee' => '4.00' // 2% of 200
        ]);
    }

    /** @test */
   public function test_approving_withdrawal_deducts_user_balance_once(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $user = User::factory()->create(['balance' => 100]);

        $wr = WithdrawalRequest::factory()->create([
            'user_id' => $user->id,
            'amount' => 50,
            'status' => 'pending',
        ]);

        $this->actingAs($admin)
            ->withoutMiddleware(VerifyCsrfToken::class) // 👈 important
            ->put(route('admin.withdrawals.update', $wr->id), [
                'status' => 'approved',
                'admin_note' => 'Approved',
            ])
            ->assertStatus(302); // redirect

        // Refresh
        $wr = $wr->fresh();
        $user = $user->fresh();

        $this->assertEquals('approved', $wr->status);
        $this->assertEquals(50, $user->balance); // deducted
    }
}
