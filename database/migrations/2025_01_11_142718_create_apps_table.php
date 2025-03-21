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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('appId')->nullable(true);
            $table->integer('affiliateId')->default(0)->nullable(true);
            $table->string('appName')->nullable(true);
            $table->string('appUrl')->nullable(true);
            $table->string('currencyName')->nullable(true);
            $table->string('currencyNameP')->nullable(true);
            $table->string('currencyValue')->nullable(true);
            $table->string('rounding')->nullable(true);
            $table->mediumText('postback')->nullable(true);
            $table->tinyInteger('status')->default(0)->nullable(true);
            $table->tinyInteger('affiliate_status')->default(0)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};
