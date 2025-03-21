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
        Schema::create('test_postbacks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->integer('app_id')->default(0);
            $table->string('payout',25)->default(0);
            $table->string('ip',50)->nullable(true);
            $table->string('status',5)->nullable(true);
            $table->string('error_detail')->nullable(true);
            $table->string('postback_url')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_postbacks');
    }
};
