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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->char('iso',2)->nullable(true);
            $table->string('name',80)->nullable(true);
            $table->string('nicename',80)->nullable(true);
            $table->char('iso3',3)->nullable(true);
            $table->smallInteger('numcode')->nullable(true);
            $table->integer('phonecode')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
