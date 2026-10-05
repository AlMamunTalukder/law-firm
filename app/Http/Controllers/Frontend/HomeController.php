<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Category;
use App\Models\Feature;
use App\Models\ImageVideo;
use App\Models\Location;
use App\Models\Member;
use App\Models\News;
use App\Models\Notice;

use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Kudashevs\ShareButtons\ShareButtons;
use App\Models\SocialMedia;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id')->where('type', 1)->whereNotNull('status')->get();
        $home_page_sliders = Slider::orderBy('id')->where('type', 2)->whereNotNull('status')->get();

        $members = Member::with('designations.designation')->whereNotNull('status')->orderBy('id')->get();
        $staffs = Member::whereHas('designations', fn($q) => $q->whereHas('designation', fn($q2) => $q2->where('type', 3)))->whereNotNull('status')->get();

        $features = Feature::whereNotNull('status')->orderBy('id')->get();
        $locations = Location::whereNotNull('status')->orderBy('order')->get();
        $news = News::whereNotNull('status')->whereNotNull('show_in_home')->orderBy('order')->limit(4)->get();

        $videos = Album::where('type', 2)->whereNotNull('status')->whereNotNull('is_show_in_home')->orderBy('order')->limit(7)->get();

        $galleryImages = Album::where('type', 1)->whereNotNull('status')->orderBy('order')->orderByDesc('id')->limit(6)->get();

        $sticky_video = Album::where('type', 2)->whereNotNull('is_home_slider_sticky')->whereNotNull('status')->limit(2)->get();
        $latestNotice = Notice::where('status', 1)
            ->orderByDesc('order')
            ->orderByDesc('id')
            ->first();

        return view('frontend.index', compact([
            'members',
            'staffs',
            'sliders',
            'features',
            'locations',
            'news',
            'videos',
            'galleryImages',
            'home_page_sliders',
            'sticky_video',
            'latestNotice',
        ]));
    }

    public function details($type, $slug = null)
    {

        $item = Setting::find(1);
        $sideNotices = collect();
        $hasMoreSideNotices = false;

        if ($type === 'notice') {
            $item = Notice::where('status', 1)
                ->when($slug, fn($query) => $query->where('slug', $slug))
                ->orderByDesc('order')
                ->orderByDesc('id')
                ->first();

            if (!$item) {
                $item = Notice::where('status', 1)->orderByDesc('order')->orderByDesc('id')->first();
            }

            if ($item) {
                $item->increment('views');

                $sideNoticeQuery = Notice::where('status', 1)
                    ->where('id', '!=', $item->id)
                    ->orderByDesc('order')
                    ->orderByDesc('id');

                $hasMoreSideNotices = $sideNoticeQuery->count() > 10;
                $sideNotices = (clone $sideNoticeQuery)->take(10)->get();
            } else {
                $item = Setting::find(1);
                $hasMoreSideNotices = false;
            }
        }

        return view('frontend.details', compact(['type', 'item', 'sideNotices', 'hasMoreSideNotices']));
    }

    public function about()
    {
        $settings = \App\Models\Setting::first();
        return view('frontend.pages.about', compact('settings'));
    }

    public function teachers()
    {

        $members = Member::with('designations.designation')
            ->whereNotNull('status')
            ->orderBy('id')
            ->paginate(12);

        return view('frontend.teachers', compact('members'));
    }
    public function contact()
    {
        $social_media = SocialMedia::get();
        return view('frontend.contact.index', compact('social_media'));
    }

    public function contactSubmit(Request $request)
    {
        if($request->filled('website')){
            return redirect()->back()->withErrors(['message'=>'Spam detected'])->withInput();
        }
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'website' => 'nullable|max:0',
        ]);
        \App\Models\ContactMessage::create($request->only(['name','email','phone','subject','message']));
        \Cache::forget('unread_contact_count');
        return redirect()->back()->with('success', 'Your message has been sent. Thank you! We will contact you soon.');
    }

}
