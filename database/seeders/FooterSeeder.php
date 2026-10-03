<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FooterSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('section_id' => '16','name' => 'জাতীয়','link' => '#','type' => '1','created_at' => '2024-09-25 10:26:01','updated_at' => '2024-09-25 10:26:01'),
            array('section_id' => '16','name' => 'সারাদেশ','link' => '#','type' => '1','created_at' => '2024-09-25 10:26:01','updated_at' => '2024-09-25 10:26:01'),
            array('section_id' => '16','name' => 'লাইফ স্টাইল','link' => '#','type' => '1','created_at' => '2024-09-25 10:26:01','updated_at' => '2024-09-25 10:26:01'),
            array('section_id' => '16','name' => 'ইসলাম ও জীবন','link' => '#','type' => '1','created_at' => '2024-09-25 10:26:01','updated_at' => '2024-09-25 10:26:01'),
            array('section_id' => '16','name' => 'একদিন প্রতিদিন','link' => '#','type' => '1','created_at' => '2024-09-25 10:26:01','updated_at' => '2024-09-25 10:26:01'),
            array('section_id' => '16','name' => 'স্বজন সমাবেশ','link' => '#','type' => '1','created_at' => '2024-09-25 10:26:01','updated_at' => '2024-09-25 10:26:01'),
            array('section_id' => '17','name' => 'আন্তর্জাতিক','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '17','name' => 'খেলা','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '17','name' => 'আইটি বিশ্ব','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '17','name' => 'রাজধানী','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '17','name' => 'সম্পাদকীয়','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '17','name' => 'প্রতিমঞ্চ','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '17','name' => 'কর্পোরেট নিউজ','link' => '#','type' => '1','created_at' => '2024-09-25 10:27:41','updated_at' => '2024-09-25 10:27:41'),
            array('section_id' => '18','name' => 'রাজনীতি','link' => '#','type' => '1','created_at' => '2024-09-25 10:28:26','updated_at' => '2024-09-25 10:28:26'),
            array('section_id' => '18','name' => 'বিনোদন','link' => '#','type' => '1','created_at' => '2024-09-25 10:28:26','updated_at' => '2024-09-25 10:28:26'),
            array('section_id' => '18','name' => 'অটোটেক','link' => '#','type' => '1','created_at' => '2024-09-25 10:28:26','updated_at' => '2024-09-25 10:28:26'),
            array('section_id' => '18','name' => 'ডাক্তার আছেন','link' => '#','type' => '1','created_at' => '2024-09-25 10:28:26','updated_at' => '2024-09-25 10:28:26'),
            array('section_id' => '18','name' => 'দৃষ্টিপাত','link' => '#','type' => '1','created_at' => '2024-09-25 10:28:26','updated_at' => '2024-09-25 10:28:26'),
            array('section_id' => '18','name' => 'সোশ্যাল মিডিয়া','link' => '#','type' => '1','created_at' => '2024-09-25 10:28:26','updated_at' => '2024-09-25 10:28:26'),
            array('section_id' => '19','name' => 'অর্থনীতি','link' => '#','type' => '1','created_at' => '2024-09-25 10:29:04','updated_at' => '2024-09-25 10:29:04'),
            array('section_id' => '19','name' => 'শিক্ষাঙ্গন','link' => '#','type' => '1','created_at' => '2024-09-25 10:29:04','updated_at' => '2024-09-25 10:29:04'),
            array('section_id' => '19','name' => 'পরবাস','link' => '#','type' => '1','created_at' => '2024-09-25 10:29:04','updated_at' => '2024-09-25 10:29:04'),
            array('section_id' => '19','name' => 'চিত্র বিচিত্র','link' => '#','type' => '1','created_at' => '2024-09-25 10:29:04','updated_at' => '2024-09-25 10:29:04'),
            array('section_id' => '19','name' => 'বাতায়ন','link' => '#','type' => '1','created_at' => '2024-09-25 10:29:04','updated_at' => '2024-09-25 10:29:04'),
            array('section_id' => '19','name' => 'সাহিত্য','link' => '#','type' => '1','created_at' => '2024-09-25 10:29:04','updated_at' => '2024-09-25 10:29:04'),
            array('section_id' => '20','name' => '<p><strong>মাওলানা আবুল বাসার নোমানী</strong></p><p><strong>প্রতিষ্ঠাতা :</strong> আল মাসজিদ ফাউন্ডেশন বাংলাদেশ</p><p>প্রকাশক কর্তৃক ক-২৪৪ প্রগতি সরণি, কুড়িল (বিশ্বরোড), বারিধারা, ঢাকা-১২২৯ থেকে প্রকাশিত এবং যমুনা প্রিন্টিং এন্ড পাবলিশিং লিঃ থেকে মুদ্রিত।</p><p>পিএবিএক্স : ৯৮২৪০৫৪-৬১, রিপোর্টিং : ৯৮২৩০৭৩, বিজ্ঞাপন : ৯৮২৪০৬২, ফ্যাক্স : ৯৮২৪০৬৩, সার্কুলেশন : ৯৮২৪০৭২। ফ্যাক্স : ৯৮২৪০৬৬</p><p>Email: companyname@gmail.com</p><p>স্বত্ব © অধিকার সংরক্ষিত</p><p></p><p></p><p></p><p></p>','link' => NULL,'type' => '2','created_at' => '2024-09-25 10:31:11','updated_at' => '2024-09-25 10:31:11')
        );
        DB::table('footers')->insert($data);
    }
}
