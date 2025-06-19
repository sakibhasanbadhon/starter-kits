<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use App\Models\Admin\WebSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WebsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $web_settings = array(
            array(
                'sitename' => 'Syntex',
                'siteurl' => 'https://www.syntex.net',
                'metatitle' => 'syntex plus Software',
                'metadescription' => 'lorem ipsam dolor ammet aven',
                'copyright_text' => 'all reserv 2024',
                'primary_color' => '#dddd',
                'created_at' => now(),
                'updated_at' => now()
            )
        );

        WebSetting::insert($web_settings);

    }
}
