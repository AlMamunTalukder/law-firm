<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NoticeController extends Controller
{
    public function index()
    {
        $items = Notice::orderByDesc('order')->orderByDesc('id')->paginate(15);
        return view('admin.notice.index', compact('items'));
    }

    public function create()
    {
        return view('admin.notice.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:notices,slug',
            'content' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
        ]);

        $object = new Notice();
        $object->title = $request->title;
        $object->slug = $request->slug ?? Str::slug($request->title);
        $object->summary = $request->summary;
        $object->content = $request->content;
        $object->order = $request->order ?? 0;
        $object->status = $request->status ?? 1;

        if ($object->save()) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $path = upload_file($object->slug, $file, 'notice');
                if ($path) {
                    $object->update(['photo' => $path]);
                }
            }

            return redirect()->route('admin.notice.index')->with('scc_msg', 'Notice added successfully.');
        }

        return back()->with('err_msg', 'Failed to save notice.');
    }

    public function edit(string $id)
    {
        $item = Notice::findOrFail($id);
        return view('admin.notice.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:notices,slug,' . $id,
            'content' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'
        ]);

        $object = Notice::findOrFail($id);
        $object->title = $request->title;
        $object->slug = $request->slug ?? Str::slug($request->title);
        $object->summary = $request->summary;
        $object->content = $request->content;
        $object->order = $request->order ?? 0;
        $object->status = $request->status ?? 1;

        if ($object->save()) {
            if ($request->has('remove_photo') && $request->remove_photo == 1) {
                if ($object->photo) {
                    File::delete(storage_path('app/public/' . $object->photo));
                    $object->update(['photo' => null]);
                }
            }
            if ($request->hasFile('photo')) {
                if ($object->photo) {
                    File::delete(storage_path('app/public/' . $object->photo));
                }

                $file = $request->file('photo');
                $path = upload_file($object->slug, $file, 'notice');
                if ($path) {
                    $object->update(['photo' => $path]);
                }
            }

            return redirect()->route('admin.notice.index')->with('scc_msg', 'Notice updated successfully.');
        }

        return back()->with('err_msg', 'Failed to update notice.');
    }

    public function destroy(string $id)
    {
        $object = Notice::findOrFail($id);
        if ($object->photo) {
            File::delete(storage_path('app/public/' . $object->photo));
        }
        $object->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notice deleted successfully.'
        ]);
    }
}
