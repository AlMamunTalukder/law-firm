<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('category_id'=>null,'name'=>'Menu1','slug'=>'menu1','type'=>1,'order'=>1,'status'=>1),
            array('category_id'=>null,'name'=>'Menu2','slug'=>'menu2','type'=>1,'order'=>2,'status'=>1),
        );
        DB::table('categories')->insert($data);
    }
}
