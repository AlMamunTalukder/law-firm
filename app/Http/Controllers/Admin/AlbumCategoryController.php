<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AlbumCategoryController extends Controller
{

    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Category::whereIn('type',[3,4])->orderBy('name');
        }
        else
        {
            $items=Category::whereIn('type',[3,4]);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    $tag = '<span class="bg-indigo-800 badge">Album Image</span>';
                    if ($row->type==4) {
                        $tag = '<span class="bg-cyan-800 badge">Album Video</span>';
                    }
                    return $row->slug.'<br/>'.$tag;
                })
                ->addColumn('name', function($row){

                    return $row->name;
                })
                ->addColumn('description', function($row){
                    $des = '';
                    if($row->important)
                    {
                        $des.='<span class="text-white bg-indigo-700 badge">Slider Image</span>';
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
                    $s_name="'".$row->slug."'";
                    $type="'".$row->type."'";
                    $status="'".$row->status."'";
                    $photo="'".$row->photo."'";
                    $route_name="'album_category'";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.'  data-photo='.$photo.' data-short_name='.$s_name.' data-album_type='.$type.' data-status='.$status.'  class="text-white edit_modal btn-info btn btn-xs">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';

                    return $btn;
                })
                ->rawColumns(['action','short_name','description','name','status'])
                ->make(true);
        }

        return view('admin.album.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Category::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Category();
            $message = __('message.scc_msg.insert');
        }

        $object->name=$request->name;
        $object->slug =$request->slug;
        if($request->slug && $request->slug=='')
        {
            $object->slug = createSlug('\category',$object->name);
        }
        $object->type=$request->album_type;
        $object->status=$request->status;

        if ($object->save()) {

            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file('album_'.$object->slug,$file,'category');
                if($path)
                {
                    $object->update([
                        'photo'=>$path,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message'=>$message,
                'data'=>$object
            ]);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object=Category::find($id);
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
}
