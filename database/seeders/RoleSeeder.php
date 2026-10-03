<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('name'=>'Super Admin','guard_name'=>'web'),
            array('name'=>'Admin','guard_name'=>'web'),
            array('name'=>'Manager','guard_name'=>'web'),
        );
        DB::table('roles')->insert($data);
    }
}
