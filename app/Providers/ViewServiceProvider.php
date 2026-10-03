<?php

namespace App\Providers;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Advertise;
use App\Models\Area;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Footer;
use App\Models\News;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    public function boot(): void
    {
        view()->composer('admin.include.division_select', function($view) {
            $divisions=Division::select('id','bn_name','code')->get()->pluck('bn_name','id')->toArray();
            $view->with([
                'divisions'=>$divisions,
            ]);
        });

        view()->composer('admin.include.district_select', function($view) {
            $districts=District::select('id','bn_name','code')->get()->pluck('bn_name','id')->toArray();
            $view->with([
                'districts'=>$districts,
            ]);
        });
        view()->composer('admin.include.area_select', function($view) {
            $areas=Area::select('id','bn_name','code')->get()->pluck('bn_name','id')->toArray();
            $view->with([
                'areas'=>$areas,
            ]);
        });

        view()->composer('layouts.frontend', function($view) {

            $menu = \Cache::remember('main_menu', 300, fn()=> Category::with('categories')->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','main_menu_category')))->whereNull(['category_id'])->whereNotNull('status')->where(['type'=>1])->orderBy('order')->get());
            $scroll_news = News::with(['categories'])->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','scroll_news')))->whereNotNull('status')->orderByDesc('action_date')->orderByDesc('id')->get()->take(8);

            $social_media = SocialMedia::get();

            $footer1 = Footer::whereHas('section',fn($q)=>$q->where('route_name','footer1'))->get();
            $footer2 = Footer::whereHas('section',fn($q)=>$q->where('route_name','footer2'))->get();
            $footer3 = Footer::whereHas('section',fn($q)=>$q->where('route_name','footer3'))->get();
            $footer4 = Footer::whereHas('section',fn($q)=>$q->where('route_name','footer4'))->get();
            $footer5 = Footer::whereHas('section',fn($q)=>$q->where('route_name','footer5'))->get();
            $view->with([

                'menu'=>$menu,

                'scroll_news'=>$scroll_news,
                'footer1'=>$footer1,
                'footer2'=>$footer2,
                'footer3'=>$footer3,
                'footer4'=>$footer4,
                'footer5'=>$footer5,
                'social_media'=>$social_media,
            ]);
        });

        view()->composer('frontend.news.include.important', function($view) {
            $important_news = News::with(['categories'])->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','important_news')))->whereNotNull('status')->orderByDesc('action_date')->get()->take(12);
            $view->with([
                'important_news'=>$important_news,
            ]);
        });

        view()->composer('frontend.news.include.most_printed', function($view) {
            $most_print_news = News::with(['categories'])->whereNotNull('status')->orderByDesc('total_print')->get()->take(7);
            $view->with([
                'most_print_news'=>$most_print_news,
            ]);
        });
        view()->composer('frontend.news.include.most_viewed', function($view) {
            $most_read_news = News::with(['categories'])->whereNotNull('status')->orderByDesc('total_visit')->get()->take(7);
            $view->with([
                'most_read_news'=>$most_read_news,
            ]);
        });

        view()->composer('*', function ($view)
        {
            $subcategories=Category::where('type',1)->whereNotNull('status')->whereNotNull('category_id')->get();
            $settings = Setting::find(1) ?? new Setting(['title'=>'Law Firm','favicon'=>'','logo'=>'']);
            $ads =Advertise::with('sections')->whereNotNull('status')->get();
            // cached counts for sidebar badges
            $unreadContact = \Cache::remember('unread_contact_count', 60, fn()=> \App\Models\ContactMessage::where('is_read',false)->count());
            $view->with([
                'subcategories'=>$subcategories,
                'ads'=>$ads,
                'settings'=>$settings,
                'unreadContact'=>$unreadContact,
            ]);
        });
    }
}
