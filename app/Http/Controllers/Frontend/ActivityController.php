<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::active()->orderBy('order')->orderByDesc('id')->paginate(12);
        return view('frontend.activities.index', compact('activities'));
    }

    public function show($slug)
    {
        $activity = Activity::where('slug', $slug)->where('status',1)->firstOrFail();
        $related = Activity::active()->where('id','!=',$activity->id)->orderByDesc('id')->take(4)->get();
        return view('frontend.activities.show', compact('activity','related'));
    }
}
