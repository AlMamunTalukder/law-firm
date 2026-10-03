<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Album;
use Spatie\Image\Image;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AlbumCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AlbumImageController extends Controller
{

    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Album::with(['categories'])->where('type',1)->orderBy('order');
        }
        else
        {
            $items=Album::with(['categories'])->where('type',1);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    if($row->photo)
                    {
                        $path = 'storage/'.str_replace("album/image/","album/image/thumbnails/",$row->photo);
                        $img = '<img class="lazy" style="width:45px" src="'.asset($path).'" />';
                    }

                    return $img;
                })

                ->addColumn('features', function($row){
                    $features = '';

                    if($row->is_featured)
                    {
                        $features.= '<span class="text-white bg-indigo-600 badge">Slider on Top</span>';
                    }
                    return $features;

                })

                ->addColumn('date', function($row){

                    return date('d/m/Y',strtotime($row->created_at));
                })
                ->addColumn('categories', function($row){
                    $des = '';
                    foreach ($row->categories as $key => $value) {
                        if($value->category){
                            $des.='<span class="text-white bg-indigo-700 badge">'.$value->category->name.'</span> ';
                        }
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

                    $route_name="'album_image'";
                    $route_name_edit=route('admin.album_image.edit', $row->id);
                    $function_name = "get_album_image_list()";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="text-white btn-info btn btn-xs">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','photo','categories','date','status','features'])
                ->make(true);
        }

        return view('admin.album.image.index');
    }

    public function create()
    {
        $categories = select2_object(Category::where('type',3)->whereNull('category_id')->get());
        return view('admin.album.image.create',compact(['categories']));
    }

    public function store(Request $request)
    {
        foreach ($request->name as $key => $value) {
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
            $object->type=$request->type[$key];
            $object->status=$request->status[$key]??null;
            $object->order=$request->order[$key]??null;
            $object->is_featured=$request->is_featured[$key]??null;
            if ($object->save()) {
                if ($request->category_id) {
                    AlbumCategory::where(['album_id'=>$object->id])->delete();
                    $cat_object = new AlbumCategory();
                    $cat_object->album_id = $object->id;
                    $cat_object->category_id = $request->category_id[$key];
                    $cat_object->save();

                }
                $file = $request->file('photo')[$key]??null;
                if($file!='')
                {
                    $path = upload_file('album_image_'.Str::random(5),$file,'album/image');
                    if($path)
                    {
                        $object->update([
                            'photo'=>$path,
                        ]);
                    }

                    if(!File::isDirectory(storage_path('app/public/album/image/thumbnails'))){
                        File::makeDirectory(storage_path('app/public/album/image/thumbnails'), 0755, true, true);
                    }
                    $exp = explode('image/',$path);
                    File::copy(storage_path('app/public/').''.$path, storage_path('app/public/album/image/thumbnails/').''.$exp[1]);
                    $thumb_path = storage_path('app/public/album/image/thumbnails/').''.$exp[1];
                    $this->createThumbnail($thumb_path, 260, 225);
                }

            }
        }
        return redirect()->route('admin.album_image.index')->with(['scc_msg'=>$message]);
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Album::with(['categories'])->find($id);
        $selected_cat = $item->categories->pluck('category_id')->toArray();
        $categories = select2_object(Category::where('type',3)->whereNull('category_id')->get());
        return view('admin.album.image.edit',compact(['categories','item','selected_cat']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object=Album::find($id);
        $name=$object->name;
        $photo=$object->photo;
        if ($object->delete()) {
            File::delete(storage_path('app/public/'.$photo));
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message'=>$msg,
                'data'=>$object
            ]);
        }
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::load($path)->resize($width, $height);
        $img->save($path);
    }
}
