<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use App\Models\ImageVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\UserCategoryPermission;

class VideoController extends Controller
{

    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=ImageVideo::with('category')->where('type',2)->orderBy('created_at');
        }
        else
        {
            $items=ImageVideo::with('category')->where('type',2);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return $row->slug;
                })
                ->addColumn('photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('logo.png').'" />';
                    if($row->link)
                    {
                        $img = '<iframe width="150" height="100" src="https://www.youtube.com/embed/'.$row->link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
                    }

                    return $img;
                })
                ->addColumn('description', function($row){
                    $des = '';
                    if($row->sticky)
                    {
                        $des.='<span class="badge text-white bg-primary">Home Sticky</span> ';
                    }

                    if($row->block)
                    {
                        $des.='<span class="badge text-white bg-indigo-500">Home Block</span> ';
                    }

                    if($row->important)
                    {
                        $des.='<span class="badge text-white bg-indigo-700">Top Video</span> ';
                    }

                    return $des;
                })
                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $name="'".$row->name."'";
                    $s_name="'".$row->category_id."'";
                    $link="'".$row->link."'";
                    $status="'".$row->status."'";
                    $important="'".$row->important."'";
                    $sticky="'".$row->sticky."'";
                    $block="'".$row->block."'";
                    $route_name="'video'";
                    $function_name = "get_image_video_list('video')";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-phone='.$link.' data-short_name='.$s_name.' data-status='.$status.' data-important='.$important.' data-sticky='.$sticky.' data-block='.$block.' class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','description','photo','status'])
                ->make(true);
        }
        $cat_assigns = UserCategoryPermission::whereHas('category',fn($q)=>$q->where('type',4))->where('user_id',auth()->user()->id)->get();

        if($cat_assigns->isEmpty())
        {
            $categories = select2_object(Category::where('type',4)->get());
        }
        else
        {
            $categories = select2_object(Category::where('type',4)->whereIn('id',$cat_assigns->pluck('category_id')->toArray())->get());
        }

        return view('admin.imagevideo.video',compact(['categories']));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=ImageVideo::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new ImageVideo();
            $message = __('message.scc_msg.insert');
        }

        $object->name=$request->name;
        $object->category_id=$request->category_id;
        $object->type=$request->type;
        $object->link=$request->link;
        $object->status=$request->status;
        $object->important=$request->important;
        $object->sticky=$request->sticky;
        $object->block=$request->block;

        if ($object->save()) {
            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message'=>$message,
                'data'=>$object
            ]);
        }
    }

    public function destroy(string $id)
    {
        $object = ImageVideo::find($id);
        $name = $object->name;
        $photo=$object->photo;
        if($object->delete())
        {
            File::delete(storage_path('app/public/'.$photo));
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'message'=>$name.' '.$msg,
                'data'=>$object
            ]);
        }
    }
}
