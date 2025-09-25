<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->timestamps();
        });

         DB::table('settings')->insert([
            ['key' => 'commission_rate_blockchain', 'value' => '0.05'],
            ['key' => 'commission_rate_manual', 'value' => '0.02'],
            ['key' => 'payout_threshold', 'value' => '100.00'],

            // MLM per-level commissions
            ['key' => 'mlm_level_1_rate', 'value' => '0.10'],
            ['key' => 'mlm_level_2_rate', 'value' => '0.05'],
            ['key' => 'mlm_level_3_rate', 'value' => '0.02'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
