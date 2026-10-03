<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __invoke(Request $request)
    {
        $total_teachers = Member::whereHas('designations',fn($q)=>$q->whereHas('designation',fn($q2)=>$q2->where('type',2)))->whereNotNull('status')->get();
        $total_sliders = Slider::whereNotNull('status')->get()->count();
        $staffs = Member::whereHas('designations',fn($q)=>$q->whereHas('designation',fn($q2)=>$q2->where('type',3)))->whereNotNull('status')->get();
        return view('admin.dashboard',compact([
            'total_teachers',
            'total_sliders',
            'staffs',
        ]));
    }
}
