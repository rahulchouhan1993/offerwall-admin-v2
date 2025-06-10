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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(true);
            $table->string('payment_method',20)->nullable(true);
            $table->string('account_name')->nullable(true);
            $table->string('iban')->nullable(true);
            $table->string('routing_number')->nullable(true);
            $table->string('swift')->nullable(true);
            $table->tinyInteger('status')->default(0)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
