<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionFeatureSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('name'=>'Dashboard'),
            array('name'=>'Category Management'),
            array('name'=>'SubCategory Management'),
            array('name'=>'News Management'),
            array('name'=>'Image Management'),
            array('name'=>'Video Management'),
            array('name'=>'Slider Management'),
            array('name'=>'Feature Management'),

            array('name'=>'User Management'),
            array('name'=>'Title,Logo,Banner Management'),
            array('name'=>'Social Media'),
            array('name'=>'Footer Widget'),
        );
        DB::table('permission_features')->insert($data);
    }
}
