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
        Schema::table('trackings', function (Blueprint $table) {
            $table->string('visitor_id',50)->nullable(true)->after('id');
            $table->string('device_type',20)->nullable(true)->after('device_os');
            $table->string('isp',50)->nullable(true)->after('device_type');
            $table->mediumText('postback_url')->nullable(true)->after('postback_sent');
            $table->string('http_code',50)->nullable(true)->after('postback_url');
            $table->mediumText('error')->nullable(true)->after('http_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trackings', function (Blueprint $table) {
            //
        });
    }
};
