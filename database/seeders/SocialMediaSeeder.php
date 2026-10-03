<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SocialMediaSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('name'=>'Facebook','link'=>'#','icon'=>'bx bxl-facebook','order'=>1),
            array('name'=>'Instagram','link'=>'#','icon'=>'bx bxl-instagram','order'=>2),
            array('name'=>'Twitter','link'=>'#','icon'=>'bxl bx-twitter-x','order'=>3),
            array('name'=>'Youtube','link'=>'#','icon'=>'bx bxl-youtube','order'=>4),
            array('name'=>'Linkedin','link'=>'#','icon'=>'bx bxl-linkedin','order'=>5),
            array('name'=>'Tiktok','link'=>'#','icon'=>'bx bxl-tiktok','order'=>6),
        );
        DB::table('social_media')->insert($data);
    }
}
