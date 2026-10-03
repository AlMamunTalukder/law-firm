<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrayerTimerSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('name'=>'ফজর','timing'=>'05:10','type'=>1,'order'=>1),
            array('name'=>'যোহর','timing'=>'12:30','type'=>1,'order'=>2),
            array('name'=>'আসর','timing'=>'16:30','type'=>1,'order'=>3),
            array('name'=>'মাগরিব','timing'=>'18:10','type'=>1,'order'=>4),
            array('name'=>'এশা','timing'=>'20:15','type'=>1,'order'=>5),
            array('name'=>'সূর্যোদয়','timing'=>'05:45','type'=>2,'order'=>6),
            array('name'=>'সূর্যাস্ত','timing'=>'18:00','type'=>2,'order'=>7),
        );
        DB::table('prayer_timers')->insert($data);
    }
}
