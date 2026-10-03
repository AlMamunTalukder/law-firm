<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        $data = array(
            array('guard_name'=>'web','permission_feature_id'=>'1','name'=>'Dashboard','route_name'=>'admin.dashboard','route_name'=>'admin.dashboard'),

            array('guard_name'=>'web','permission_feature_id'=>'2','name'=>'Category List','route_name'=>'admin.category.index'),
            array('guard_name'=>'web','permission_feature_id'=>'2','name'=>'Category Create','route_name'=>'admin.category.create'),
            array('guard_name'=>'web','permission_feature_id'=>'2','name'=>'Category Edit/Update','route_name'=>'admin.category.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'2','name'=>'Category Delete','route_name'=>'admin.category.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'3','name'=>'SubCategory List','route_name'=>'admin.subcategory.index'),
            array('guard_name'=>'web','permission_feature_id'=>'3','name'=>'SubCategory Create','route_name'=>'admin.subcategory.create'),
            array('guard_name'=>'web','permission_feature_id'=>'3','name'=>'SubCategory Edit/Update','route_name'=>'admin.subcategory.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'3','name'=>'SubCategory Delete','route_name'=>'admin.subcategory.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'4','name'=>'News List','route_name'=>'admin.news.index'),
            array('guard_name'=>'web','permission_feature_id'=>'4','name'=>'News Create','route_name'=>'admin.news.create'),
            array('guard_name'=>'web','permission_feature_id'=>'4','name'=>'News Edit/Update','route_name'=>'admin.news.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'4','name'=>'News Delete','route_name'=>'admin.news.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'5','name'=>'Image List','route_name'=>'admin.image.index'),
            array('guard_name'=>'web','permission_feature_id'=>'5','name'=>'Image Create','route_name'=>'admin.image.create'),
            array('guard_name'=>'web','permission_feature_id'=>'5','name'=>'Image Edit/Update','route_name'=>'admin.image.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'5','name'=>'Image Delete','route_name'=>'admin.image.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'6','name'=>'Video List','route_name'=>'admin.video.index'),
            array('guard_name'=>'web','permission_feature_id'=>'6','name'=>'Video Create','route_name'=>'admin.video.create'),
            array('guard_name'=>'web','permission_feature_id'=>'6','name'=>'Video Edit/Update','route_name'=>'admin.video.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'6','name'=>'Video Delete','route_name'=>'admin.video.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'7','name'=>'Slider List','route_name'=>'admin.slider.index'),
            array('guard_name'=>'web','permission_feature_id'=>'7','name'=>'Slider Create','route_name'=>'admin.slider.create'),
            array('guard_name'=>'web','permission_feature_id'=>'7','name'=>'Slider Edit/Update','route_name'=>'admin.slider.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'7','name'=>'Slider Delete','route_name'=>'admin.slider.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'8','name'=>'Feature List','route_name'=>'admin.feature.index'),
            array('guard_name'=>'web','permission_feature_id'=>'8','name'=>'Feature Create','route_name'=>'admin.feature.create'),
            array('guard_name'=>'web','permission_feature_id'=>'8','name'=>'Feature Edit/Update','route_name'=>'admin.feature.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'8','name'=>'Feature Delete','route_name'=>'admin.feature.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'11','name'=>'User List','route_name'=>'admin.user.index'),
            array('guard_name'=>'web','permission_feature_id'=>'11','name'=>'User Create','route_name'=>'admin.user.create'),
            array('guard_name'=>'web','permission_feature_id'=>'11','name'=>'User Edit/Update','route_name'=>'admin.user.edit'),
            array('guard_name'=>'web','permission_feature_id'=>'11','name'=>'User Delete','route_name'=>'admin.user.destroy'),

            array('guard_name'=>'web','permission_feature_id'=>'12','name'=>'Title,Logo,Banner Update','route_name'=>'admin.setting.index'),
            array('guard_name'=>'web','permission_feature_id'=>'13','name'=>'Social Media Update','route_name'=>'admin.socialmedia.index'),

            array('guard_name'=>'web','permission_feature_id'=>'14','name'=>'Footer Widget Update','route_name'=>'admin.footer.index'),

        );
        DB::table('permissions')->insert($data);
    }
}
