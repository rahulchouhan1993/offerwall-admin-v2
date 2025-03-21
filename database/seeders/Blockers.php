<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Blockers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('app_blockers')->insert([
            array('id' => '1','name' => 'Block VPN Acces
            ','enabled' => '0','countries' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'Block Rooted Devices','enabled' => '0','countries' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => 'Termux Block','enabled' => '0','countries' => NULL,'created_at' => NULL,'updated_at' => '2025-01-10 17:16:33'),
            array('id' => '4','name' => 'Emulator Block','enabled' => '0','countries' => NULL,'created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','name' => 'Country Block','enabled' => '0','countries' => NULL,'created_at' => NULL,'updated_at' => '2025-02-08 10:57:58')
        ]);
    }
}
