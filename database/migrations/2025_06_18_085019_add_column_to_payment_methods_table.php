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
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('account_type')->nullable(true)->after('swift');
            $table->string('country',5)->nullable(true)->after('account_type');
            $table->string('city')->nullable(true)->after('country');
            $table->mediumText('address')->nullable(true)->after('city');
            $table->string('post_code',20)->nullable(true)->after('address');
            $table->string('wallet_address')->nullable(true)->after('post_code');
            $table->string('paypal_email')->nullable(true)->after('wallet_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            //
        });
    }
};
