<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin/','as'=>'admin.','namespace'=>'Admin','middleware' => ['auth','has_permissions']],function() {

        Route::get('dashboard', 'DashboardController')->name('dashboard');

        Route::resource('news', 'NewsController');
        Route::resource('feature', 'FeatureController');
        Route::resource('notice', 'NoticeController');
        Route::resource('category', 'CategoryController');
        Route::resource('subcategory', 'SubcategoryController');

        Route::resource('imagecategory', 'ImageCategoryController')->only(['index','store','destroy']);
        Route::resource('image', 'ImageController')->only(['index','store','destroy']);
        Route::resource('video', 'VideoController')->only(['index','store','destroy']);
        Route::resource('slider', 'SliderController')->only(['index','store','destroy']);

        Route::resource('voting', 'VotingController');
        Route::resource('ads', 'AdsController');
        Route::resource('location', 'LocationController');

        Route::resource('album_category', 'AlbumCategoryController');
        Route::resource('album_image', 'AlbumImageController');
        Route::resource('album_video', 'AlbumVideoController');

        Route::get('website_info', 'SettingController@website_info')->name('website_info.index');
        Route::post('website_info_update', 'SettingController@website_info_update')->name('website_info.update');

        Route::get('setting', 'SettingController@index')->name('setting.index');
        Route::post('setting', 'SettingController@update')->name('setting.update');

        Route::resource('activities', 'ActivityController')->except(['show']);

        Route::resource('socialmedia', 'SocialMediaController')->only(['index','store']);
        Route::resource('prayertimer', 'PrayerTimerController')->only(['index','store']);
        Route::resource('footer', 'FooterController')->only(['index','edit','update']);

        Route::resource('user', 'UserController');
        Route::resource('member', 'MemberController');
        Route::resource('writer', 'WriterController');
        Route::resource('designation', 'DesignationController');

        Route::get('assign-category/{type_id}/{user_id}', 'UserController@assign_category_user')->name('assigncategory.index');
        Route::post('assign-category/{type_id}/{user_id}', 'UserController@assign_category')->name('assigncategory.store');

        Route::resource('role', 'RoleController')->only(['index','store','destroy']);
        Route::get('assign-permission-route/{role_id}', 'RoleController@assign_permission')->name('assign_permission_to_role.index');
        Route::post('assign-permission-route-store/{role_id}', 'RoleController@assign_permission_submit')->name('assign_permission_to_role.store');
        Route::resource('permission', 'PermissionController')->only(['index','store','destroy']);

        Route::resource('division', 'DivisionController')->only(['index','store','destroy']);
        Route::resource('district', 'DistrictController')->only(['index','store','destroy']);
        Route::resource('area', 'AreaController')->only(['index','store','destroy']);

        Route::get('profile', 'ProfileController@show')->name('profile.show');
        Route::post('profile/update', 'ProfileController@update')->name('profile.update');

        Route::post('media/remove', 'MediaController@remove')->name('media.remove');

        Route::get('contact-messages', 'ContactMessageController@index')->name('contact_messages.index');
        Route::get('contact-messages/{id}', 'ContactMessageController@show')->name('contact_messages.show');
        Route::delete('contact-messages/{id}', 'ContactMessageController@destroy')->name('contact_messages.destroy');

        Route::resource('change_password', 'ChangePasswordController')->only('index','update');
        Route::resource('backup', 'BackupController')->except('update','edit','create');

});
