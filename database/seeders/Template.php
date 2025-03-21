<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Template extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates')->insert([
            array('id' => '1','user_id' => NULL,'app_id' => NULL,'bodyBg' => '#d196f8','headerTextColor' => '#1e1f1f','headerButtonBg' => '#937ea5','headerButtonColor' => '#1e1f1f','NotificationBg' => '#ece0f5','notificationText' => '#212121','offerBg' => '#9a86ac','offerBgInner' => '#e8e0f5','offerText' => '#212121','offerInfoBg' => '#d0bbe2','offerInfoText' => '#2f2d2d','offerInfoBorder' => '#d59dfb','offerButtonBg' => '#e7f4bd','offerButtonText' => '#505346','footerText' => '#9514eb','created_at' => NULL,'updated_at' => '2025-02-06 18:09:57'),
        ]);
    }
}
