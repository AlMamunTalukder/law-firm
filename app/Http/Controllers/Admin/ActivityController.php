<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::orderBy('order')->orderByDesc('id');
        if ($request->ajax()) {
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('image', fn($row) => $row->image ? '<img src="'.asset('storage/'.$row->image).'" style="width:60px;height:40px;object-fit:cover;border-radius:8px;">' : '<span class="text-muted">—</span>')
                ->addColumn('status_badge', fn($row) => $row->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>')
                ->addColumn('action', function($row){
                    $edit = route('admin.activities.edit', $row->id);
                    return '<div class="btn-group"><a href="'.$edit.'" class="btn btn-info btn-xs">Edit</a><a href="javascript:void(0)" data-id="'.$row->id.'" data-route="activities" data-fname="get_activity_list()" class="delete_record_specific btn btn-danger btn-xs">Delete</a></div>';
                })
                ->rawColumns(['image','status_badge','action'])
                ->make(true);
        }
        return view('admin.activities.index');
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'excerpt'=>'nullable|string|max:500',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'order'=>'nullable|integer',
        ]);
        $data = $request->only(['title','excerpt','description','order']);
        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['created_by'] = auth()->id();
        $data['order'] = (int)($data['order'] ?? 0);
        $orig = $data['slug']; $i=1;
        while(Activity::where('slug',$data['slug'])->exists()){ $data['slug'] = $orig.'-'.$i++; }
        if($request->hasFile('image')){
            $data['image'] = upload_file($data['slug'], $request->file('image'), 'activities');
        }
        Activity::create($data);
        return redirect()->route('admin.activities.index')->with('scc_msg','Activity created');
    }

    public function edit($id)
    {
        $item = Activity::findOrFail($id);
        return view('admin.activities.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Activity::findOrFail($id);
        $request->validate([
            'title'=>'required|string|max:255',
            'excerpt'=>'nullable|string|max:500',
            'description'=>'nullable|string',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'order'=>'nullable|integer',
        ]);
        $data = $request->only(['title','excerpt','description','order']);
        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->has('status') ? 1 : 0;
        $data['updated_by'] = auth()->id();
        $data['order'] = (int)($data['order'] ?? 0);
        $orig = $data['slug']; $i=1;
        while(Activity::where('slug',$data['slug'])->where('id','!=',$id)->exists()){ $data['slug'] = $orig.'-'.$i++; }
        if($request->has('remove_image') && $item->image){
            if(Storage::disk('public')->exists($item->image)) Storage::disk('public')->delete($item->image);
            $data['image'] = null;
        }
        if($request->hasFile('image')){
            if($item->image && Storage::disk('public')->exists($item->image)) Storage::disk('public')->delete($item->image);
            $data['image'] = upload_file($data['slug'], $request->file('image'), 'activities');
        }
        $item->update($data);
        return redirect()->route('admin.activities.index')->with('scc_msg','Activity updated');
    }

    public function destroy($id)
    {
        $item = Activity::findOrFail($id);
        if($item->image && Storage::disk('public')->exists($item->image)) Storage::disk('public')->delete($item->image);
        $item->delete();
        return response()->json(['success'=>true,'message'=>'Deleted']);
    }
}
