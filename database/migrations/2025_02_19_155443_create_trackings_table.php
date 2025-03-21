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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('app_id')->default(0)->nullable(true);
            $table->integer('offer_id')->default(0)->nullable(true);
            $table->integer('user_id')->default(0)->nullable(true);
            $table->integer('affiliate_id')->default(0)->nullable(true);
            $table->string('country_code')->nullable(true);
            $table->string('country_name')->nullable(true);
            $table->string('browser')->nullable(true);
            $table->string('device_brand')->nullable(true);
            $table->string('device_model')->nullable(true);
            $table->string('device_os')->nullable(true);
            $table->string('ip')->nullable(true);
            $table->string('ua')->nullable(true);
            $table->string('goal')->nullable(true);
            $table->string('click_id')->nullable(true);
            $table->dateTime('click_time')->nullable(true);
            $table->string('conversion_id')->nullable(true);
            $table->dateTime('conversion_time')->nullable(true);
            $table->string('payout', 10, 2)->nullable(true);
            $table->string('revenue', 10, 2)->nullable(true);
            $table->tinyInteger('postback_sent')->default(0);
            $table->tinyInteger('status')->default(0)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
