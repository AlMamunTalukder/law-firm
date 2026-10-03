<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelHasRoleSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('role_id'=>'1','model_type'=>'App\Models\User','model_id'=>1),

            array('role_id'=>'2','model_type'=>'App\Models\User','model_id'=>2),
            array('role_id'=>'3','model_type'=>'App\Models\User','model_id'=>2),
        );
        DB::table('model_has_roles')->insert($data);
    }
}
