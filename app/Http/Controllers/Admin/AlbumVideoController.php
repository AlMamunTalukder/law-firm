<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Album;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AlbumCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AlbumVideoController extends Controller
{

    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Album::with(['categories'])->where('type',2)->orderBy('order');
        }
        else
        {
            $items=Album::with(['categories'])->where('type',2);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    if($row->photo)
                    {
                        $path = 'storage/'.$row->photo;
                        $img = '<img style="width:45px" src="'.asset($path).'" />';
                    }

                    return $img;
                })

                ->addColumn('type', function($row){

                    $v_type = '<span class="text-white bg-cyan-700 badge">Youtube Video</span>';
                    if($row->video_type==2)
                    {
                        $v_type = '<span class="text-white bg-cyan-700 badge">DailyMotion Video</span>';
                    }
                    if($row->video_type==3)
                    {
                        $v_type = '<span class="text-white bg-cyan-700 badge">Uploaded Video</span>';
                    }
                    return $v_type;
                })

                ->addColumn('features', function($row){
                    $features = '';
                    if($row->is_show_in_home)
                    {
                        $features.= '<span class="text-white bg-blue-600 badge">Show in Home Page</span><br>';
                    }
                    if($row->is_home_slider_sticky)
                    {
                        $features.= '<span class="text-white bg-orange-600 badge">Show above on Image Slider</span><br>';
                    }
                    if($row->is_featured)
                    {
                        $features.= '<span class="text-white bg-indigo-600 badge">Show Feature Video</span>';
                    }
                    return $features;

                })

                ->addColumn('date', function($row){
                    return date('d/m/Y',strtotime($row->created_at));
                })
                ->addColumn('categories', function($row){
                    $des = '';
                    foreach ($row->categories as $key => $value) {
                        $des.='<span class="text-white bg-indigo-700 badge">'.$value->category->name.'</span> ';
                    }
                    return $des;
                })
                ->filterColumn('categories', function($query, $keyword) {
                    $query->whereHas('categories', fn($q) => $q->whereHas('category',fn($q4)=>$q4->where('name','like', '%'.$keyword.'%')));
                })
                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){

                    $route_name="'album_video'";
                    $route_video_link = $row->link;
                    if ($row->video_type==3) {
                        $route_video_link = asset('storage/'.$row->link);
                    }

                    $route_name_edit=route('admin.album_video.edit', $row->id);
                    $function_name = "get_album_video_list()";
                    $btn = '<div class="btn-group"><a data-link="'.$route_video_link.'" class="text-white bg-teal-600 copy_link btn btn-xs">Video Link</a><a href="'.$route_name_edit.'" class="text-white btn-info btn btn-xs">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','photo','categories','date','type','status','features'])
                ->make(true);
        }

        return view('admin.album.video.index');
    }

    public function create()
    {
        $categories = select2_object(Category::where('type',4)->whereNull('category_id')->get());
        return view('admin.album.video.create',compact(['categories']));
    }

    public function store(Request $request)
    {
        foreach ($request->name as $key => $value)
        {
            if($request->table_id)
            {
                $object=Album::find($request->table_id);
                $message = __('message.scc_msg.update');
            }
            else{
                $object=new Album();
                $message = __('message.scc_msg.insert');
            }
            $object->name=$value;
            $object->link=$request->link[$key];
            $object->type=$request->type[$key];
            $object->video_type=$request->video_type[$key] ?? null;
            $object->status=$request->status[$key] ?? null;
            $object->order=$request->order[$key] ?? null;
            $object->is_show_in_home=$request->is_show_in_home[$key] ?? null;
            $object->is_home_slider_sticky=$request->is_home_slider_sticky[$key] ?? null;
            $object->is_featured=$request->is_featured[$key] ?? null;
            if ($object->save()) {
                if ($request->category_id) {
                    AlbumCategory::where(['album_id'=>$object->id])->delete();
                    $cat_object = new AlbumCategory();
                    $cat_object->album_id = $object->id;
                    $cat_object->category_id = $request->category_id[$key];
                    $cat_object->save();

                }
                $file = $request->file('video')[$key]??'';
                if($file!='')
                {
                    $path = upload_file('album_video_'.Str::random(5),$file,'album/video');
                    if($path)
                    {
                        $object->update([
                            'link'=>$path,
                        ]);
                    }
                }
                $file = $request->file('photo');
                if($file!='')
                {
                    $path = upload_file('album_image_'.Str::random(5),$file,'album/video/thumbnail');
                    if($path)
                    {
                        $object->update([
                            'photo'=>$path,
                        ]);
                    }
                }

            }
        }
        return redirect()->route('admin.album_video.index')->with(['scc_msg'=>$message]);
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Album::with(['categories'])->find($id);
        $selected_cat = $item->categories->pluck('category_id')->toArray();
        $categories = select2_object(Category::where('type',4)->whereNull('category_id')->get());
        return view('admin.album.video.edit',compact(['categories','item','selected_cat']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object=Album::find($id);
        $photo=$object->photo;
        $video=$object->link;
        $video_type=$object->video_type;
        $name=$object->name;
        if ($object->delete()) {
            File::delete(storage_path('app/public/'.$photo));
            if ($video_type==3) {
                File::delete(storage_path('app/public/'.$video));
            }

            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message'=>$msg,
                'data'=>$object
            ]);
        }
    }
}
