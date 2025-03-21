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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('advertiser_name',50)->nullable(true)->after('content');
            $table->string('affise_api_key',50)->nullable(true)->after('advertiser_name');
            $table->string('affise_endpoint',100)->nullable(true)->after('affise_api_key');
            $table->string('allowed_ips')->nullable(true)->after('affise_endpoint');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
