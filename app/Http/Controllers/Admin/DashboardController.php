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
        $teamMembers = Member::whereNotNull('status')->count();
        $insights = \App\Models\News::whereNotNull('status')->count();
        $notices = \App\Models\Notice::where('status', 1)->count();
        $messages = \App\Models\ContactMessage::count();
        $unreadMessages = \App\Models\ContactMessage::where('is_read', false)->count();
        $total_sliders = Slider::whereNotNull('status')->get()->count();
        $gallery = \App\Models\Album::where('type', 1)->whereNotNull('status')->count();
        return view('admin.dashboard',compact([
            'teamMembers',
            'insights',
            'notices',
            'messages',
            'unreadMessages',
            'total_sliders',
            'gallery',
        ]));
    }
}
