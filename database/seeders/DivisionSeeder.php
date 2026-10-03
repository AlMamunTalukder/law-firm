<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{

    public function run()
    {
        $divisions = array(
            array('id' => '1','name' => 'Chattagram','bn_name' => 'চট্টগ্রাম','code' => '01','url' => 'www.chittagongdiv.gov.bd'),
            array('id' => '2','name' => 'Rajshahi','bn_name' => 'রাজশাহী','code' => '03','url' => 'www.rajshahidiv.gov.bd'),
            array('id' => '3','name' => 'Khulna','bn_name' => 'খুলনা','code' => '04','url' => 'www.khulnadiv.gov.bd'),
            array('id' => '4','name' => 'Barisal','bn_name' => 'বরিশাল','code' => '05','url' => 'www.barisaldiv.gov.bd'),
            array('id' => '5','name' => 'Sylhet','bn_name' => 'সিলেট','code' => '06','url' => 'www.sylhetdiv.gov.bd'),
            array('id' => '6','name' => 'Dhaka','bn_name' => 'ঢাকা','code' => '02','url' => 'www.dhakadiv.gov.bd'),
            array('id' => '7','name' => 'Rangpur','bn_name' => 'রংপুর','code' => '07','url' => 'www.rangpurdiv.gov.bd'),
            array('id' => '8','name' => 'Mymensingh','bn_name' => 'ময়মনসিংহ','code' => '08','url' => 'www.mymensinghdiv.gov.bd')
        );

        DB::table('divisions')->insert($divisions);

    }
}
