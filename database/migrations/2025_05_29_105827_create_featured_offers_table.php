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
        Schema::create('featured_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id')->nullable();
            $table->string('devices')->nullable();
            $table->mediumText('countries')->nullable();
            $table->longText('affiliates')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('featured_offers');
    }
};
