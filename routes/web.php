<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();
Route::fallback(function () {

    return view('errors.403_front');
});

Route::POST('/order-sortable', 'AjaxController@order_update')->name('order.sortable');
Route::POST('/seen_counter/{id}', 'AjaxController@seen_counter')->name('seen_counter');
Route::POST('/voting-submit/{id}', 'AjaxController@voting_submit')->name('voting.submit');
Route::GET('/get-districts', 'AjaxController@get_districts')->name('get.districts');
Route::GET('/get-areas', 'AjaxController@get_areas')->name('get.areas');

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::get('details/{type}/{slug?}', 'HomeController@details')->name('all.details');
    // Notices pages hidden from live site (admin + data kept)
    // Route::get('notices', 'NoticeController@index')->name('notices.index');
    // Route::get('notices/{slug}', 'NoticeController@show')->name('notices.show');
    // Route::get('n/{id}', 'NoticeController@short')->name('notice.short');

    Route::get('image', 'ImageController@index')->name('image');
    Route::get('member-info/{slug?}', 'NewsController@member_details')->name('front_member.details');

    Route::get('news/category/image', 'ImageController@index')->name('image.category.list');

    Route::get('image/{category}', 'ImageController@category')->name('image.category');

    Route::get('video', 'VideoController@index')->name('video');

    Route::get('/news', 'VideoController@index')->name('news.index');
    Route::get('news/category/video', 'VideoController@index')->name('video.category.list');
    Route::get('video/{category}', 'VideoController@category')->name('video.category');

    Route::get('news/category/{category_name}', 'NewsController@index')->name('news');
    Route::get('news/category/{category_name}/all', 'NewsController@all_news')->name('news.all');
    Route::get('news/{slug}', 'NewsController@show')->name('news.details');

    Route::get('news/location/{location_name}', 'LocationController@index')->name('news.location');
    Route::get('news/location/{location_name}/all', 'LocationController@all_news')->name('news.location.all');
    Route::get('our-team', 'HomeController@teachers')->name('teachers.index');
    Route::redirect('teachers', 'our-team', 301);
    Route::get('contact', 'HomeController@contact')->name('contact');
    Route::post('contact', 'HomeController@contactSubmit')->middleware('throttle:5,1')->name('contact.submit');

    Route::get('our-activities', 'ActivityController@index')->name('activities.index');
    Route::get('our-activities/{slug}', 'ActivityController@show')->name('activities.show');

});

require __DIR__.'/admin.php';Route::get('sitemap.xml', function(){
    $urls = collect([route('home'), route('contact')]);
    return response()->view('sitemap', compact('urls'))->header('Content-Type','text/xml');
});
