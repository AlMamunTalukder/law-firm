<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::where('status', 1)
            ->orderByDesc('order')
            ->orderByDesc('id')
            ->paginate(12);

        return view('frontend.notices.index', compact('notices'));
    }

    public function show($slug)
    {
        return redirect()->route('all.details', ['type' => 'notice', 'slug' => $slug]);
    }

    public function short($id)
    {
        $notice = \App\Models\Notice::findOrFail($id);
        return redirect()->route('all.details', ['type' => 'notice', 'slug' => $notice->slug]);
    }
}
