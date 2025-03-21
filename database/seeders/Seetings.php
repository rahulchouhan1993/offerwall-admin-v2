<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Seetings extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            array('id' => '1','default_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','default_image' => '1739698377.png','default_info' => 'Complete this offer to get free cash','support_email' => 'test@gmail.com','twitter' => 'http://127.0.0.1:8001/settings','linkedin' => 'http://127.0.0.1:8001/settings/1','facebook' => '/private/var/tmp/php1j6tcj0vsft540aPaP2','conversion_report' => '1','postback_report' => '0','content' => 'test','created_at' => NULL,'updated_at' => '2025-02-16 09:34:07')
        ]);
    }
}
