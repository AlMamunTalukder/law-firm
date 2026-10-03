<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesignationSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('order' => NULL,'name' => 'Director','type' => '1','created_at' => NULL,'updated_at' => NULL),
            array('order' => NULL,'name' => 'Executive','type' => '1','created_at' => NULL,'updated_at' => NULL),
            array('order' => NULL,'name' => 'Senior Teacher','type' => '2','created_at' => NULL,'updated_at' => NULL),
            array('order' => NULL,'name' => 'Assistant Teacher','type' => '2','created_at' => NULL,'updated_at' => NULL),
            array('order' => NULL,'name' => 'Staff','type' => '3','created_at' => NULL,'updated_at' => NULL),

        );

        DB::table('designations')->insert($data);
    }
}
