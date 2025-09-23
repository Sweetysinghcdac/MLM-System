<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
      use RefreshDatabase;

    public function test_transaction_awards_points_and_commission()
    {
        $referrer = User::factory()->create();
        $child = User::factory()->create(['referrer_id' => $referrer->id]);

        $this->actingAs($child)->post('/transactions', [
            'amount' => 100,
            'mode' => 'blockchain',
        ])->assertRedirect('/dashboard');

        $this->assertDatabaseHas('transactions', ['user_id' => $child->id, 'amount' => 100]);
        $referrer->refresh();
        // points awarded to child
        $this->assertEquals(100, $child->refresh()->points);
        // referrer commission: 10% of 100 points = 10
        $this->assertEquals(10, $referrer->balance);
    }
}
