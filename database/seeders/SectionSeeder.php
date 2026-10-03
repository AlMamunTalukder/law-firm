<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('route_name'=>'scroll_news','name'=>'Scroll News','type'=>1),
            array('route_name'=>'home4','name'=>'Home Top News 4','type'=>1),
            array('route_name'=>'top_corner','name'=>'Home Top Corner News','type'=>1),
            array('route_name'=>'sticky_news','name'=>'Home Sticky News','type'=>1),
            array('route_name'=>'block6_news','name'=>'Home Block News 6','type'=>1),
            array('route_name'=>'important_news','name'=>'Important News','type'=>1),
            array('route_name'=>'sticky_category_news','name'=>'Category Sticky News','type'=>1),
            array('route_name'=>'writer_category_news','name'=>'Show on Home Writer Category','type'=>1),
            array('route_name'=>'main_menu_category','name'=>'Show on Main Menu','type'=>2),
            array('route_name'=>'big_box_category','name'=>'Big Box Category Section','type'=>2),
            array('route_name'=>'box_category','name'=>'Box Category Section','type'=>2),
            array('route_name'=>'block_category','name'=>'Block Category Section','type'=>2),
            array('route_name'=>'bottom_category1','name'=>'Home Bottom Block Category1','type'=>2),
            array('route_name'=>'bottom_category2','name'=>'Home Bottom Block Category2','type'=>2),
            array('route_name'=>'bottom_category3','name'=>'Home Bottom Block Category3','type'=>2),
            array('route_name'=>'footer1','name'=>'Footer Column 1','type'=>3),
            array('route_name'=>'footer2','name'=>'Footer Column 2','type'=>3),
            array('route_name'=>'footer3','name'=>'Footer Column 3','type'=>3),
            array('route_name'=>'footer4','name'=>'Footer Column 4','type'=>3),
            array('route_name'=>'footer5','name'=>'Footer Column 5','type'=>3),
            array('route_name'=>'home_top_square_ad1','name'=>'Square Home Top Right1','type'=>4),
            array('route_name'=>'home_top_square_ad2','name'=>'Square Home Top Right2','type'=>4),
            array('route_name'=>'home_top_horizontal_ad','name'=>'Horizontal After Home News 6','type'=>4),
            array('route_name'=>'home_bottom_horizontal_ad1','name'=>'Horizontal After Block Category Left','type'=>4),
            array('route_name'=>'home_bottom_horizontal_ad2','name'=>'Horizontal After Block Category Right','type'=>4),
            array('route_name'=>'news_category_top_horizontal','name'=>'Horizontal News Category Top','type'=>4),
            array('route_name'=>'news_category_top_square_ad1','name'=>'Square News Category Top Right1','type'=>4),
            array('route_name'=>'news_category_top_square_ad2','name'=>'Square News Category Top Right2','type'=>4),
            array('route_name'=>'news_top_horizontal','name'=>'Horizontal News Top','type'=>4),
            array('route_name'=>'news_top_square_ad1','name'=>'Square News Top Right1','type'=>4),
            array('route_name'=>'news_top_square_ad2','name'=>'Square News Top Right2','type'=>4),
            array('route_name'=>'news_top_square_ad3','name'=>'Square News Right3','type'=>4),
            array('route_name'=>'news_top_square_ad4','name'=>'Square News Right4','type'=>4),
            array('route_name'=>'news_inside_square','name'=>'Square Inside News','type'=>4),
            array('route_name'=>'news_horizontal_bottom','name'=>'Horizontal Bottom News','type'=>4),
            array('route_name'=>'news_horizontal_similar1','name'=>'Horizontal Similar News1','type'=>4),
            array('route_name'=>'news_horizontal_similar2','name'=>'Horizontal Similar News2','type'=>4),
            array('route_name'=>'news_horizontal_similar3','name'=>'Horizontal Similar News3','type'=>4),

        );
        DB::table('sections')->insert($data);
    }
}
