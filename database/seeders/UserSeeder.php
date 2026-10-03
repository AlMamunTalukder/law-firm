<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('name' => 'Super Admin','email'=>'sadmin@gmail.com','password'=>Hash::make('12345678')),
            array('name' => 'Admin','email'=>'admin@gmail.com','password'=>Hash::make('12345678')),
            array('name' => 'Manager','email'=>'manager@gmail.com','password'=>Hash::make('12345678')),
        );

        DB::table('users')->insert($data);
    }
}
