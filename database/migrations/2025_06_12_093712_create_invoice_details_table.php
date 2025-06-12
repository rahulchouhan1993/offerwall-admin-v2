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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->default(null)->nullable(true);
            $table->string('description')->default(null)->nullable(true);
            $table->integer('conversion')->default(null)->nullable(true);
            $table->decimal('payout', 10, 2)->nullable();
            $table->integer('vat')->default(null)->nullable(true);
            $table->tinyInteger('item_type')->default(0)->comment('0 = positive 1=negetive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
