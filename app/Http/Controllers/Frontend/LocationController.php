<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Category;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index($slug)
    {
        $category = Division::where(['name'=>$slug])->first();
        if(!$category) abort(404);

        $sticky = News::with(['categories','sections'])->where('division_id',$category->id)->whereNotNull('status')->orderByDesc('action_date')->whereHas('sections',fn($q)=>$q->whereHas('section',fn($q2)=>$q2->where('route_name','sticky_category_news')))->first();
        $items = News::whereNotIn('id',[$sticky->id ?? ''])->where('division_id',$category->id)->whereNotNull('status')->orderByDesc('action_date')->paginate(12);

        return view('frontend.news.index',compact(['category','sticky','items']));
    }
    public function all_news($slug)
    {
        $category = Division::where(['name'=>$slug])->first();
        if(!$category) abort(404);
        $items = News::where('division_id',$category->id)->orderByDesc('action_date')->paginate(40);
        return view('frontend.news.all',compact(['category','items']));
    }
}
