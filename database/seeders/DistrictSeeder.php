<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{

    public function run()
    {
        $districts = array(
            array('id' => '1','division_id' => '1','name' => 'Comilla','bn_name' => 'কুমিল্লা','code' => '10','lat' => '23.4682747','lon' => '91.1788135','url' => 'www.comilla.gov.bd'),
  array('id' => '2','division_id' => '1','name' => 'Feni','bn_name' => 'ফেনী','code' => '06','lat' => '23.023231','lon' => '91.3840844','url' => 'www.feni.gov.bd'),
  array('id' => '3','division_id' => '1','name' => 'Brahmanbaria','bn_name' => 'ব্রাহ্মণবাড়িয়া','code' => '11','lat' => '23.9570904','lon' => '91.1119286','url' => 'www.brahmanbaria.gov.bd'),
  array('id' => '4','division_id' => '1','name' => 'Rangamati','bn_name' => 'রাঙ্গামাটি','code' => '04','lat' => NULL,'lon' => NULL,'url' => 'www.rangamati.gov.bd'),
  array('id' => '5','division_id' => '1','name' => 'Noakhali','bn_name' => 'নোয়াখালী','code' => '08','lat' => '22.869563','lon' => '91.099398','url' => 'www.noakhali.gov.bd'),
  array('id' => '6','division_id' => '1','name' => 'Chandpur','bn_name' => 'চাঁদপুর','code' => '09','lat' => '23.2332585','lon' => '90.6712912','url' => 'www.chandpur.gov.bd'),
  array('id' => '7','division_id' => '1','name' => 'Lakshmipur','bn_name' => 'লক্ষীপুর','code' => '07','lat' => '22.942477','lon' => '90.841184','url' => 'www.lakshmipur.gov.bd'),
  array('id' => '8','division_id' => '1','name' => 'Chattogram','bn_name' => 'চট্টগ্রাম','code' => '01','lat' => '22.335109','lon' => '91.834073','url' => 'www.chittagong.gov.bd'),
  array('id' => '9','division_id' => '1','name' => 'Coxsbazar','bn_name' => 'কক্সবাজার','code' => '02','lat' => NULL,'lon' => NULL,'url' => 'www.coxsbazar.gov.bd'),
  array('id' => '10','division_id' => '1','name' => 'Khagrachhari','bn_name' => 'খাগড়াছড়ি','code' => '05','lat' => '23.119285','lon' => '91.984663','url' => 'www.khagrachhari.gov.bd'),
  array('id' => '11','division_id' => '1','name' => 'Bandarban','bn_name' => 'বান্দরবান','code' => '03','lat' => '22.1953275','lon' => '92.2183773','url' => 'www.bandarban.gov.bd'),
  array('id' => '12','division_id' => '2','name' => 'Sirajganj','bn_name' => 'সিরাজগঞ্জ','code' => '39','lat' => '24.4533978','lon' => '89.7006815','url' => 'www.sirajganj.gov.bd'),
  array('id' => '13','division_id' => '2','name' => 'Pabna','bn_name' => 'পাবনা','code' => '40','lat' => '23.998524','lon' => '89.233645','url' => 'www.pabna.gov.bd'),
  array('id' => '14','division_id' => '2','name' => 'Bogura','bn_name' => 'বগুড়া','code' => '37','lat' => '24.8465228','lon' => '89.377755','url' => 'www.bogra.gov.bd'),
  array('id' => '15','division_id' => '2','name' => 'Rajshahi','bn_name' => 'রাজশাহী','code' => '33','lat' => NULL,'lon' => NULL,'url' => 'www.rajshahi.gov.bd'),
  array('id' => '16','division_id' => '2','name' => 'Natore','bn_name' => 'নাটোর','code' => '38','lat' => '24.420556','lon' => '89.000282','url' => 'www.natore.gov.bd'),
  array('id' => '17','division_id' => '2','name' => 'Joypurhat','bn_name' => 'জয়পুরহাট','code' => '36','lat' => NULL,'lon' => NULL,'url' => 'www.joypurhat.gov.bd'),
  array('id' => '18','division_id' => '2','name' => 'Chapainawabganj','bn_name' => 'চাঁপাইনবাবগঞ্জ','code' => '34','lat' => '24.5965034','lon' => '88.2775122','url' => 'www.chapainawabganj.gov.bd'),
  array('id' => '19','division_id' => '2','name' => 'Naogaon','bn_name' => 'নওগাঁ','code' => '35','lat' => NULL,'lon' => NULL,'url' => 'www.naogaon.gov.bd'),
  array('id' => '20','division_id' => '3','name' => 'Jashore','bn_name' => 'যশোর','code' => '52','lat' => '23.16643','lon' => '89.2081126','url' => 'www.jessore.gov.bd'),
  array('id' => '21','division_id' => '3','name' => 'Satkhira','bn_name' => 'সাতক্ষীরা','code' => '55','lat' => NULL,'lon' => NULL,'url' => 'www.satkhira.gov.bd'),
  array('id' => '22','division_id' => '3','name' => 'Meherpur','bn_name' => 'মেহেরপুর','code' => '58','lat' => '23.762213','lon' => '88.631821','url' => 'www.meherpur.gov.bd'),
  array('id' => '23','division_id' => '3','name' => 'Narail','bn_name' => 'নড়াইল','code' => '57','lat' => '23.172534','lon' => '89.512672','url' => 'www.narail.gov.bd'),
  array('id' => '24','division_id' => '3','name' => 'Chuadanga','bn_name' => 'চুয়াডাঙ্গা','code' => '51','lat' => '23.6401961','lon' => '88.841841','url' => 'www.chuadanga.gov.bd'),
  array('id' => '25','division_id' => '3','name' => 'Kushtia','bn_name' => 'কুষ্টিয়া','code' => '54','lat' => '23.901258','lon' => '89.120482','url' => 'www.kushtia.gov.bd'),
  array('id' => '26','division_id' => '3','name' => 'Magura','bn_name' => 'মাগুরা','code' => '56','lat' => '23.487337','lon' => '89.419956','url' => 'www.magura.gov.bd'),
  array('id' => '27','division_id' => '3','name' => 'Khulna','bn_name' => 'খুলনা','code' => '49','lat' => '22.815774','lon' => '89.568679','url' => 'www.khulna.gov.bd'),
  array('id' => '28','division_id' => '3','name' => 'Bagerhat','bn_name' => 'বাগেরহাট','code' => '50','lat' => '22.651568','lon' => '89.785938','url' => 'www.bagerhat.gov.bd'),
  array('id' => '29','division_id' => '3','name' => 'Jhenaidah','bn_name' => 'ঝিনাইদহ','code' => '53','lat' => '23.5448176','lon' => '89.1539213','url' => 'www.jhenaidah.gov.bd'),
  array('id' => '30','division_id' => '4','name' => 'Jhalakathi','bn_name' => 'ঝালকাঠি','code' => '61','lat' => NULL,'lon' => NULL,'url' => 'www.jhalakathi.gov.bd'),
  array('id' => '31','division_id' => '4','name' => 'Patuakhali','bn_name' => 'পটুয়াখালী','code' => '64','lat' => '22.3596316','lon' => '90.3298712','url' => 'www.patuakhali.gov.bd'),
  array('id' => '32','division_id' => '4','name' => 'Pirojpur','bn_name' => 'পিরোজপুর','code' => '63','lat' => NULL,'lon' => NULL,'url' => 'www.pirojpur.gov.bd'),
  array('id' => '33','division_id' => '4','name' => 'Barisal','bn_name' => 'বরিশাল','code' => '59','lat' => NULL,'lon' => NULL,'url' => 'www.barisal.gov.bd'),
  array('id' => '34','division_id' => '4','name' => 'Bhola','bn_name' => 'ভোলা','code' => '62','lat' => '22.685923','lon' => '90.648179','url' => 'www.bhola.gov.bd'),
  array('id' => '35','division_id' => '4','name' => 'Barguna','bn_name' => 'বরগুনা','code' => '60','lat' => NULL,'lon' => NULL,'url' => 'www.barguna.gov.bd'),
  array('id' => '36','division_id' => '5','name' => 'Sylhet','bn_name' => 'সিলেট','code' => '25','lat' => '24.8897956','lon' => '91.8697894','url' => 'www.sylhet.gov.bd'),
  array('id' => '37','division_id' => '5','name' => 'Moulvibazar','bn_name' => 'মৌলভীবাজার','code' => '27','lat' => '24.482934','lon' => '91.777417','url' => 'www.moulvibazar.gov.bd'),
  array('id' => '38','division_id' => '5','name' => 'Habiganj','bn_name' => 'হবিগঞ্জ','code' => '28','lat' => '24.374945','lon' => '91.41553','url' => 'www.habiganj.gov.bd'),
  array('id' => '39','division_id' => '5','name' => 'Sunamganj','bn_name' => 'সুনামগঞ্জ','code' => '26','lat' => '25.0658042','lon' => '91.3950115','url' => 'www.sunamganj.gov.bd'),
  array('id' => '40','division_id' => '6','name' => 'Narsingdi','bn_name' => 'নরসিংদী','code' => '20','lat' => '23.932233','lon' => '90.71541','url' => 'www.narsingdi.gov.bd'),
  array('id' => '41','division_id' => '6','name' => 'Gazipur','bn_name' => 'গাজীপুর','code' => '13','lat' => '24.0022858','lon' => '90.4264283','url' => 'www.gazipur.gov.bd'),
  array('id' => '42','division_id' => '6','name' => 'Shariatpur','bn_name' => 'শরীয়তপুর','code' => '21','lat' => NULL,'lon' => NULL,'url' => 'www.shariatpur.gov.bd'),
  array('id' => '43','division_id' => '6','name' => 'Narayanganj','bn_name' => 'নারায়নগঞ্জ','code' => '15','lat' => '23.63366','lon' => '90.496482','url' => 'www.narayanganj.gov.bd'),
  array('id' => '44','division_id' => '6','name' => 'Tangail','bn_name' => 'টাঙ্গাইল','code' => '24','lat' => NULL,'lon' => NULL,'url' => 'www.tangail.gov.bd'),
  array('id' => '45','division_id' => '6','name' => 'Kishoreganj','bn_name' => 'কিশোরগঞ্জ','code' => '23','lat' => '24.444937','lon' => '90.776575','url' => 'www.kishoreganj.gov.bd'),
  array('id' => '46','division_id' => '6','name' => 'Manikganj','bn_name' => 'মানিকগঞ্জ','code' => '14','lat' => NULL,'lon' => NULL,'url' => 'www.manikganj.gov.bd'),
  array('id' => '47','division_id' => '6','name' => 'Dhaka','bn_name' => 'ঢাকা','code' => '12','lat' => '23.7115253','lon' => '90.4111451','url' => 'www.dhaka.gov.bd'),
  array('id' => '48','division_id' => '6','name' => 'Munshiganj','bn_name' => 'মুন্সিগঞ্জ','code' => '16','lat' => NULL,'lon' => NULL,'url' => 'www.munshiganj.gov.bd'),
  array('id' => '49','division_id' => '6','name' => 'Rajbari','bn_name' => 'রাজবাড়ী','code' => '22','lat' => '23.7574305','lon' => '89.6444665','url' => 'www.rajbari.gov.bd'),
  array('id' => '50','division_id' => '6','name' => 'Madaripur','bn_name' => 'মাদারীপুর','code' => '19','lat' => '23.164102','lon' => '90.1896805','url' => 'www.madaripur.gov.bd'),
  array('id' => '51','division_id' => '6','name' => 'Gopalganj','bn_name' => 'গোপালগঞ্জ','code' => '17','lat' => '23.0050857','lon' => '89.8266059','url' => 'www.gopalganj.gov.bd'),
  array('id' => '52','division_id' => '6','name' => 'Faridpur','bn_name' => 'ফরিদপুর','code' => '18','lat' => '23.6070822','lon' => '89.8429406','url' => 'www.faridpur.gov.bd'),
  array('id' => '53','division_id' => '7','name' => 'Panchagarh','bn_name' => 'পঞ্চগড়','code' => '45','lat' => '26.3411','lon' => '88.5541606','url' => 'www.panchagarh.gov.bd'),
  array('id' => '54','division_id' => '7','name' => 'Dinajpur','bn_name' => 'দিনাজপুর','code' => '43','lat' => '25.6217061','lon' => '88.6354504','url' => 'www.dinajpur.gov.bd'),
  array('id' => '55','division_id' => '7','name' => 'Lalmonirhat','bn_name' => 'লালমনিরহাট','code' => '46','lat' => NULL,'lon' => NULL,'url' => 'www.lalmonirhat.gov.bd'),
  array('id' => '56','division_id' => '7','name' => 'Nilphamari','bn_name' => 'নীলফামারী','code' => '42','lat' => '25.931794','lon' => '88.856006','url' => 'www.nilphamari.gov.bd'),
  array('id' => '57','division_id' => '7','name' => 'Gaibandha','bn_name' => 'গাইবান্ধা','code' => '47','lat' => '25.328751','lon' => '89.528088','url' => 'www.gaibandha.gov.bd'),
  array('id' => '58','division_id' => '7','name' => 'Thakurgaon','bn_name' => 'ঠাকুরগাঁও','code' => '44','lat' => '26.0336945','lon' => '88.4616834','url' => 'www.thakurgaon.gov.bd'),
  array('id' => '59','division_id' => '7','name' => 'Rangpur','bn_name' => 'রংপুর','code' => '41','lat' => '25.7558096','lon' => '89.244462','url' => 'www.rangpur.gov.bd'),
  array('id' => '60','division_id' => '7','name' => 'Kurigram','bn_name' => 'কুড়িগ্রাম','code' => '48','lat' => '25.805445','lon' => '89.636174','url' => 'www.kurigram.gov.bd'),
  array('id' => '61','division_id' => '8','name' => 'Sherpur','bn_name' => 'শেরপুর','code' => '31','lat' => '25.0204933','lon' => '90.0152966','url' => 'www.sherpur.gov.bd'),
  array('id' => '62','division_id' => '8','name' => 'Mymensingh','bn_name' => 'ময়মনসিংহ','code' => '29','lat' => NULL,'lon' => NULL,'url' => 'www.mymensingh.gov.bd'),
  array('id' => '63','division_id' => '8','name' => 'Jamalpur','bn_name' => 'জামালপুর','code' => '32','lat' => '24.937533','lon' => '89.937775','url' => 'www.jamalpur.gov.bd'),
  array('id' => '64','division_id' => '8','name' => 'Netrokona','bn_name' => 'নেত্রকোণা','code' => '30','lat' => '24.870955','lon' => '90.727887','url' => 'www.netrokona.gov.bd')
        );

        DB::table('districts')->insert($districts);
    }
}
