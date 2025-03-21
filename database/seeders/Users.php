<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            array('id' => '1','unique_id' => '0','affiseId' => NULL,'affise_api_key' => NULL,'affise_postback_key' => NULL,'name' => 'Admin','last_name' => 'Offerwall','role' => 'admin','email' => 'admin@offerwall.com','api_key' => NULL,'postback_key' => NULL,'status' => '1','email_verified_at' => NULL,'password' => '$2y$12$8c4BVTGNtuhGMgXkPTMSt.0c6s1rA5mrQIWdmrw/wBlYdZdCE29Vm','remember_token' => NULL,'created_at' => NULL,'updated_at' => '2025-02-10 18:22:53')
        ]);
    }
}
