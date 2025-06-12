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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(null);
            $table->date('start_date')->default(null);
            $table->date('end_date')->default(null);
            $table->string('invoice_number')->default(null);
            $table->date('invoice_date')->default(null);
            $table->date('due_date')->default(null);
            $table->integer('status')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
