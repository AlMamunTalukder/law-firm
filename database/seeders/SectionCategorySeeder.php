<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionCategorySeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('section_id' => '9','category_id' => '2','created_at' => '2024-09-28 15:37:32','updated_at' => '2024-09-28 15:37:32'),
            array('section_id' => '12','category_id' => '2','created_at' => '2024-09-28 15:37:32','updated_at' => '2024-09-28 15:37:32'),
            array('section_id' => '9','category_id' => '9','created_at' => '2024-09-28 15:37:52','updated_at' => '2024-09-28 15:37:52'),
            array('section_id' => '11','category_id' => '9','created_at' => '2024-09-28 15:37:52','updated_at' => '2024-09-28 15:37:52'),
            array('section_id' => '9','category_id' => '11','created_at' => '2024-09-28 15:38:03','updated_at' => '2024-09-28 15:38:03'),
            array('section_id' => '11','category_id' => '11','created_at' => '2024-09-28 15:38:03','updated_at' => '2024-09-28 15:38:03'),
            array('section_id' => '9','category_id' => '4','created_at' => '2024-09-28 15:38:25','updated_at' => '2024-09-28 15:38:25'),
            array('section_id' => '12','category_id' => '4','created_at' => '2024-09-28 15:38:25','updated_at' => '2024-09-28 15:38:25'),
            array('section_id' => '9','category_id' => '3','created_at' => '2024-09-28 15:38:38','updated_at' => '2024-09-28 15:38:38'),
            array('section_id' => '12','category_id' => '3','created_at' => '2024-09-28 15:38:38','updated_at' => '2024-09-28 15:38:38'),
            array('section_id' => '9','category_id' => '6','created_at' => '2024-09-28 15:38:50','updated_at' => '2024-09-28 15:38:50'),
            array('section_id' => '12','category_id' => '6','created_at' => '2024-09-28 15:38:50','updated_at' => '2024-09-28 15:38:50'),
            array('section_id' => '9','category_id' => '5','created_at' => '2024-09-28 15:38:59','updated_at' => '2024-09-28 15:38:59'),
            array('section_id' => '12','category_id' => '5','created_at' => '2024-09-28 15:38:59','updated_at' => '2024-09-28 15:38:59'),
            array('section_id' => '9','category_id' => '8','created_at' => '2024-09-28 15:39:15','updated_at' => '2024-09-28 15:39:15'),
            array('section_id' => '14','category_id' => '8','created_at' => '2024-09-28 15:39:15','updated_at' => '2024-09-28 15:39:15'),
            array('section_id' => '9','category_id' => '7','created_at' => '2024-09-28 15:58:27','updated_at' => '2024-09-28 15:58:27'),
            array('section_id' => '13','category_id' => '7','created_at' => '2024-09-28 15:58:27','updated_at' => '2024-09-28 15:58:27'),
            array('section_id' => '9','category_id' => '10','created_at' => '2024-09-28 15:58:43','updated_at' => '2024-09-28 15:58:43'),
            array('section_id' => '15','category_id' => '10','created_at' => '2024-09-28 15:58:43','updated_at' => '2024-09-28 15:58:43'),
            array('section_id' => '9','category_id' => '1','created_at' => '2024-09-28 15:58:56','updated_at' => '2024-09-28 15:58:56'),
            array('section_id' => '10','category_id' => '1','created_at' => '2024-09-28 15:58:56','updated_at' => '2024-09-28 15:58:56'),
            array('section_id' => '12','category_id' => '1','created_at' => '2024-09-28 15:58:56','updated_at' => '2024-09-28 15:58:56')
        );
        DB::table('section_categories')->insert($data);
    }
}
