<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Member;
use App\Models\News;
use App\Models\NewsCategory;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index($slug)
    {
        $category = Category::where(['slug'=>$slug])->whereNotNull('status')->first();
        if(!$category) abort(404);

        if($category->is_single_news == 1){
            $news_data = News::where('id', $category->news_url)->first(['slug']);
            if($news_data){
                return redirect('news/'.$news_data->slug);
            }
            else{
                return redirect()->route('home');
            }
        }
        if(!$category) abort(404);
        $sticky = News::with(['categories','sections'])->whereHas('categories',fn($q)=>$q->where('category_id',$category->id))->whereNotNull('status')->orderByDesc('action_date')->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','sticky_category_news')))->first();
        $items = News::whereNotIn('id',[$sticky->id??''])->whereHas('categories',fn($q)=>$q->where('category_id',$category->id))->orderByDesc('action_date')->paginate(12);

        return view('frontend.news.index',compact(['category','sticky','items']));
    }
    public function all_news($slug)
    {
        $category = Category::where(['slug'=>$slug])->whereNotNull('status')->first();
        if(!$category) abort(404);
        $items = News::whereHas('categories',fn($q)=>$q->where('category_id',$category->id))->orderByDesc('action_date')->paginate(12);
        return view('frontend.news.all',compact(['category','items']));
    }
    public function show($slug)
    {
        $item = News::with(['district','writer'])->where(['slug'=>$slug])->first();
        if(!$item) abort(404);
        $cat = NewsCategory::with('category')->where('news_id',$item->id)->whereHas('category',fn($q)=>$q->whereNull('category_id'))->get();
        $news_category = (!$cat->isEmpty())?$cat[0]:null;
        if(!$news_category || !$news_category->category) abort(404);

        $relatedNewsQuery = News::whereNotIn('id',[$item->id])
            ->whereHas('categories', fn($q) => $q->where('category_id', $news_category->category->id))
            ->orderByDesc('action_date');

        $relatedNews = (clone $relatedNewsQuery)->take(10)->get();
        $hasMoreRelatedNews = (clone $relatedNewsQuery)->count() > 10;

        $item->update([
            'total_visit'=>$item->total_visit+1
        ]);

        $cat_info = Category::where('is_single_news',1)->where('news_url',$item->id)->first();
        $single_news = 0;
        if(!empty($cat_info) && $cat_info->is_single_news == 1){
            $single_news = 1;
        }
        $top_corner_news = News::with(['categories'])->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','top_corner')))->whereNotNull('status')->orderByDesc('action_date')->orderByDesc('id')->first();
        $home4 = News::with(['categories'])->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','home4')))->whereNotNull('status')->orderByDesc('action_date')->get()->take(4);

        return view('frontend.news.show',compact([
            'item',
            'relatedNews',
            'hasMoreRelatedNews',
            'news_category',
            'single_news',
            'top_corner_news',
            'home4'
        ]));
    }

    public function member_details($slug='')
    {
        if($slug!='')
        {
            $item = Member::with(['designations'])->where(['slug'=>$slug])->first();
            if(!$item) abort(404);
            return view('frontend.member_details',compact(['item']));
        }
        else {
            return redirect()->route('home');
        }

    }
}
