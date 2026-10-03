<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('name'=>'LawFirm','short_name'=>'LawFirm','title'=>'Law Firm','logo'=>'settings/basic/logo.png','favicon'=>'settings/basic/favicon.png','banner'=>'settings/basic/banner.webp','admin_logo'=>'settings/basic/company-logo.png','footer_logo'=>'settings/basic/footer-logo.jpg','copyright'=>'Copyright © 2024  Law Firm. All rights reserved.'),

        );
        DB::table('settings')->insert($data);
    }
}
