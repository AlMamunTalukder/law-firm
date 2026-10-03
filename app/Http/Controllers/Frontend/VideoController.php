<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function index()
    {
        $items = \App\Models\Album::where('type',2)->whereNotNull('status')->orderBy('order')->orderByDesc('id')->paginate(12);
        return view('frontend.video.index',compact(['items']));
    }

    public function category($slug)
    {
        $category = Category::where(['slug'=>$slug,'type'=>4])->whereNotNull('status')->first();
        if (!$category) abort(404);
        $items = \App\Models\Album::where('type',2)->whereNotNull('status')->whereHas('categories', fn($q)=>$q->where('category_id',$category->id))->orderBy('order')->orderByDesc('id')->paginate(12);
        return view('frontend.video.category',compact(['items','category']));
    }
}
