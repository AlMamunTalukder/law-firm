<?php
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use App\Models\SectionCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Kudashevs\ShareButtons\ShareButtons;
use Rakibhstu\Banglanumber\NumberToBangla;

    if (!function_exists("select2_object")) {
        function select2_object($object)
        {
            $array_object = [];
            foreach ($object as $key => $value) {
                $extra='';
                if ($value->code) {
                    $extra = $value->code;
                }
                elseif($value->phone) {
                    $extra = $value->phone;
                }
                elseif($value->account_no) {
                    $extra = $value->account_no;
                }
                else{
                    $extra = '';
                }
                ($extra!='')?$array_object[$value->id] = ($value->class_name?$value->class_name.' ':"").''.$value->name.' ('.$extra.')':$array_object[$value->id] = $value->name;

            }
            return $array_object;
        }
    }

    if (!function_exists("select2_object_custom")) {
        function select2_object_custom($object,$table_col_name)
        {
            $array_object = [];
            foreach ($object as $key => $value) {
                $array_object[$value->id] = $value->$table_col_name;
            }
            return $array_object;
        }
    }

    if (!function_exists("createSlug")) {
        function createSlug($table_model,$title, $id = 0)
        {
            $slug = Str::slug($title);
            $allSlugs = getRelatedSlugs($table_model,$slug, $id);
            if (! $allSlugs->contains('slug', $slug)){
                return $slug;
            }

            for ($i = 1; $i <= 50; $i++) {
                $newSlug = $slug.'-'.$i;
                if (! $allSlugs->contains('slug', $newSlug)) {
                    return $newSlug;
                }
            }
            throw new \Exception('Can not create a unique slug');
        }
    }

    if (!function_exists("getRelatedSlugs")) {
        function getRelatedSlugs($table_model,$slug, $id = 0)
        {
            $model_name = "App\Models".$table_model;
            $data= $model_name::where('slug', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
                return $data;
        }
    }

    if (!function_exists("numberFormatBD")) {
        function numberFormatBD($amount, $decimals=0)
        {

            $sign='';
             if ($amount<0) {
                $sign='-';
                $amount = trim($amount,'-');
            }

            if(is_numeric($amount))
            {
                $tmp = explode(".",$amount);
                $strMoney = '';
                $divide = 1000;
                $amount = $tmp[0];
                $strMoney .= str_pad($amount%$divide,3,"0",STR_PAD_LEFT);
                $amount = (int)($amount/$divide);
                while($amount>0)
                {
                    $divide = 100;
                    $strMoney = str_pad($amount%$divide, 2,"0",STR_PAD_LEFT).",".$strMoney;
                    $amount = (int)($amount/$divide);
                }

                if(substr($strMoney, 0, 1) == "0")
                $strMoney = substr($strMoney,1);

                if(isset($tmp[1]))
                {
                    $fraction = $tmp[1];
                    if(strlen($fraction)==1)
                    {
                        $fraction = $tmp[1].'0';
                    }
                return $sign.''.$strMoney.".".$fraction;
                }
                return $sign.''.$strMoney.'.00';
            }
        }
    }

    if (!function_exists("floatval")) {
        function floatval($val)
        {
            $val = str_replace(",",".",$val);
            $val = preg_replace('/\.(?=.*\.)/', '', $val);
            return $val;
        }
    }

    if (!function_exists("bn_date")) {
        function bn_date($date)
        {
            $numto = new NumberToBangla();
            $ex_date =explode("-",$date);
            $item = $numto->bnNum($ex_date[2]).' '.$numto->bnMonth($ex_date[1]).','.$numto->bnNum($ex_date[0]);
            return $item;
        }
    }

    if (!function_exists("eng_format_date")) {
        function eng_format_date($date)
        {
            $numto = new NumberToBangla();
            $ex_date =explode("-",$date);
            $item = $numto->bnNum($ex_date[2]).'/'.$numto->bnNum($ex_date[1]).'/'.$numto->bnNum(substr($ex_date[0],-2));
            return $item;
        }
    }

    if (!function_exists("bn_date_short")) {
        function bn_date_short($date)
        {
            $numto = new NumberToBangla();
            $ex_date =explode("-",$date);
            $item = $numto->bnNum($ex_date[2]).' '.$numto->bnMonth($ex_date[1]).','.$numto->bnNum(substr($ex_date[0],-2));
            return $item;
        }
    }

    if (!function_exists("bnNum_year_range")) {
        function bnNum_year_range($year_range)
        {
            $numto = new NumberToBangla();
            $ex_date =explode("-",$year_range);
            $item = $numto->bnNum($ex_date[0]).'-'.$numto->bnNum($ex_date[1]);
            return $item;
        }
    }
    if (!function_exists("salary_month")) {
        function salary_month($date)
        {
            $numto = new NumberToBangla();
            $ex_date =explode("-",$date);
            $item = $numto->bnMonth($ex_date[1]).', '.$numto->bnNum($ex_date[0]);
            return $item;
        }
    }

    if (!function_exists('enToBnDate')) {

        function enToBnDate(string $date, $show_time = false): string
        {
            if ($show_time) {
                $carbonDate = Carbon::parse($date);
                $date = $carbonDate->format('d-m-Y সময়: h:i A');
            }

            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $banglaNumbers  = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

            $englishMeridiem = ['AM', 'PM'];
            $banglaMeridiem = ['এএম', 'পিএম'];

            $englishMonths = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            $banglaMonths = [
                'জানুয়ারি',
                'ফেব্রুয়ারি',
                'মার্চ',
                'এপ্রিল',
                'মে',
                'জুন',
                'জুলাই',
                'আগস্ট',
                'সেপ্টেম্বর',
                'অক্টোবর',
                'নভেম্বর',
                'ডিসেম্বর'
            ];

            $englishTime = ['hours', 'hour', 'minutes', 'minute', 'seconds', 'second', 'ago', 'days', 'day', 'month', 'months', 'year', 'years'];
            $banglaTime = ['ঘণ্টা', 'ঘণ্টা', 'মিনিট', 'মিনিট', 'সেকেন্ড', 'সেকেন্ড', 'আগে', 'দিন', 'দিন', 'মাস', 'মাস', 'বছর', 'বছর'];

            $converted = str_replace($englishTime, $banglaTime, $date);
            $converted = str_replace($englishMonths, $banglaMonths, $converted);
            $converted = str_replace($englishNumbers, $banglaNumbers, $converted);

            return $converted;
        }
    }

    if (!function_exists("months_name_from_range")) {
        function months_name_from_range($start_date,$end_date)
        {
            $period = CarbonPeriod::create($start_date, $end_date)->month();
            $months = collect($period)->map(function (Carbon $date) {
                return [
                    'month' => $date->month,
                    'name' => $date->monthName,
                    'days' => $date->daysInMonth,
                    'year' => $date->year,
                ];
            });
            return $months;
        }
    }

    if (!function_exists("months_rang_from_date_range")) {
        function months_rang_from_date_range($start_date,$end_date)
        {
            $numto = new NumberToBangla();
            $ex_date =explode("-",$start_date);
            $ex_date1 =explode("-",$end_date);

            if($ex_date[0]==$ex_date1[0] && $ex_date[1]==$ex_date1[1])
            {
                $item = $numto->bnMonth($ex_date[1]).','.$numto->bnNum($ex_date[0]);
            }
            else
            {
                $item = $numto->bnMonth($ex_date[1]).','.$numto->bnNum($ex_date[0]).' থেকে '.$numto->bnMonth($ex_date1[1]).','.$numto->bnNum($ex_date1[0]);
            }

            return $item;
        }
    }

    if (!function_exists("b2eNum")) {
        function b2eNum($number){
            $search_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
            $replace_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
            $en_number = str_replace($search_array, $replace_array, $number);

            return $en_number;
        }
    }
    if (!function_exists("e2bNum")) {
        function e2bNum($number){
            $replace_array= array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
            $search_array= array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
            $en_number = str_replace($search_array, $replace_array, $number);

            return $en_number;
        }
    }

    if (!function_exists("e2bTimePeriod")) {
        function e2bTimePeriod($period){
            $duration_text = '';
            if($period=='seconds' || $period=='second')
            {
                $duration_text = 'সেকেন্ড';
            }

            if($period=='minutes' || $period=='minute')
            {
                $duration_text = 'মিনিট';
            }

            if($period=='hours' || $period=='hour')
            {
                $duration_text = 'ঘন্টা';
            }
            if($period=='days' || $period=='day')
            {
                $duration_text = 'দিন';
            }

            if($period=='weeks' || $period=='week')
            {
                $duration_text = 'সপ্তাহ';
            }

            if($period=='months' || $period=='month')
            {
                $duration_text = 'মাস';
            }

            if($period=='years' || $period=='year')
            {
                $duration_text = 'বছর';
            }

            return $duration_text;
        }
    }

    if (!function_exists("bnNum")) {
        function bnNum($number){
            $numto = new NumberToBangla();
            if(is_numeric($number))
            {
                $item = $numto->bnNum($number);
                return $item;
            }

        }
    }
    if (!function_exists("bnWord")) {
        function bnWord($number){
            $numto = new NumberToBangla();
            if(is_numeric($number))
            {
                $item = $numto->bnWord($number);
                return $item;
            }
        }
    }
    if (!function_exists("bnMoney")) {
        function bnMoney($number){
            $numto = new NumberToBangla();
            if(fmod($number, 1) !== 0.00){
                $item = $numto->bnMoney($number);
            } else {
                $item = $numto->bnMoney((int)$number);
            }

            return $item;
        }
    }
    if (!function_exists("bnMonth")) {
        function bnMonth($number){
            $numto = new NumberToBangla();
            $item = $numto->bnMonth($number);
            return $item;
        }
    }

    if (!function_exists("bnCommaLakh")) {
        function bnCommaLakh($number){
            $numto = new NumberToBangla();
            $item = $numto->bnCommaLakh($number);
            return $item;
        }
    }

    if (!function_exists("month_range_from_date_to_date"))
    {
        function month_range_from_date_to_date($start_date,$end_date)
        {
            $toDate = Carbon::parse($start_date);
            $fromDate = Carbon::parse($end_date);

            $months = (int) $toDate->diffInMonths($fromDate);
            $months = $months+1;

            return $months;
        }
    }

    if (!function_exists("multiKeyExists")) {
        function multiKeyExists($arr,$main_key,$sub_key)
        {

            foreach ($arr as $element) {
                if (is_array($element)) {
                    if (array_key_exists($sub_key, $element)) {
                        return true;
                    }
                }
            }
            return false;

        }
    }

    if (!function_exists("upload_file")) {
    function upload_file($obj_name, $file, $path)
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $file_name = \Illuminate\Support\Str::slug($obj_name) . '-' . time() . '.' . $extension;

            $stored = $file->storeAs($path, $file_name, 'public');

            if ($stored) {
                \Log::info('File uploaded successfully: ' . $stored);
                return $stored;
            }

            \Log::error('Failed to upload file');
            return false;
        } catch (\Exception $e) {
            \Log::error('Upload error: ' . $e->getMessage());
            return false;
        }
    }
}

    if (!function_exists("show_on_main_menu")) {
        function show_on_main_menu($category_id)
        {
            $exist = SectionCategory::whereHas('section',fn($q)=>$q->where('route_name','main_menu_category'))->where(['category_id'=>$category_id])->first();

            if($exist)
            {
                return true;
            }
            return false;
        }
    }

    if (!function_exists("get_ads")) {
        function get_ads($ads,$position)
        {
            foreach ($ads->sortByDesc('id') as $key => $value) {
                foreach ($value->sections as $key => $sec) {
                    if($sec->section->route_name==$position)
                    {
                        return $value;
                    }
                }
            }
            return false;
        }
    }

     if (!function_exists("parse_youtube_video_id")) {
        function parse_youtube_video_id($url) {
            if(empty($url) || !is_string($url)) return null;
            $url = trim($url);
            // already an embed URL: /embed/VIDEOID
            if(preg_match('~youtube\.com/embed/([A-Za-z0-9_-]{11})~', $url, $m)) return $m[1];
            // shorts: /shorts/VIDEOID
            if(preg_match('~youtube\.com/shorts/([A-Za-z0-9_-]{11})~', $url, $m)) return $m[1];
            // youtu.be/VIDEOID
            if(preg_match('~youtu\.be/([A-Za-z0-9_-]{11})~', $url, $m)) return $m[1];
            // watch?v=VIDEOID (may have extra params)
            if(preg_match('~[?&]v=([A-Za-z0-9_-]{11})~', $url, $m)) return $m[1];
            // live: /live/VIDEOID
            if(preg_match('~youtube\.com/live/([A-Za-z0-9_-]{11})~', $url, $m)) return $m[1];
            return null;
        }
    }

     if (!function_exists("parse_youtube_video_url")) {
        function parse_youtube_video_url($url) {
            $id = parse_youtube_video_id($url);
            return $id ? 'https://www.youtube.com/embed/'.$id : null;
        }
    }

     if (!function_exists("parse_youtube_video_url_for_image")) {
        function parse_youtube_video_url_for_image($url) {
            return parse_youtube_video_id($url);
        }
    }

    if (!function_exists("make_slug")) {
        function make_slug($string) {
            return preg_replace('/\s+/u', '-', trim($string));
        }
    }

    if (!function_exists("posted_time_diff_bd")){
        function posted_time_diff_bd($date){
            $diff = Carbon::parse($date)->diffForHumans();
            $time_diff = explode(' ',$diff);
            $duration = e2bNum($time_diff[0]);
            $duration_text = e2bTimePeriod($time_diff[1]);
            return $duration.' '.$duration_text.' আগে';
        }
    }
?>
