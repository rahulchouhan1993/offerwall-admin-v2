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
        Schema::create('traffic_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('tracking_id')->nullable(true);
            $table->string('device')->nullable(true);
            $table->string('os')->nullable(true);
            $table->string('country')->nullable(true);
            $table->string('caps')->nullable(true);
            $table->string('agent')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabel_traffic_trackings');
    }
};
