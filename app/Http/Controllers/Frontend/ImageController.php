<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ImageVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function index()
    {
        // Use Album for home gallery consistency - paginate 12 per page for all devices, next/prev
        $items = \App\Models\Album::where('type',1)->whereNotNull('status')->orderBy('order')->orderByDesc('id')->paginate(12);
        return view('frontend.image.index',compact(['items']));
    }

    public function category($slug)
    {
        $category = Category::where(['slug'=>$slug,'type'=>3])->whereNotNull('status')->first();
        if (!$category) abort(404);
        $items = \App\Models\Album::where('type',1)->whereNotNull('status')->whereHas('categories', fn($q)=>$q->where('category_id',$category->id))->orderBy('order')->orderByDesc('id')->paginate(12);
        return view('frontend.image.category',compact(['items','category']));
    }
}
