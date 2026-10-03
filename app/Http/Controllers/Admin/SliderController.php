<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{

    public function index(Request $request)
    {
        $items=Slider::orderBy('created_at','desc');
        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('title', function($row){
                    return $row->title;
                })
                ->addColumn('subtitle', function($row){
                    return $row->subtitle;
                })

                ->addColumn('type', function($row){
                    $type = 'Main Slider';
                    if ($row->type==2) {
                        $type = 'Home Page 2nd Slider';
                    }
                    return $type;
                })
                ->addColumn('slider_photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    {
                        $path = 'storage/'.$row->photo;
                        $img = '<img style="width:45px" src="'.asset($path).'" />';
                    }

                    return $img;
                })
                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $title="'".$row->title."'";
                    $subtitle="'".$row->subtitle."'";
                    $slider_photo="'".$row->photo."'";
                    $type="'".$row->type."'";
                    $status="'".$row->status."'";
                    $route_name="'slider'";
                    $function_name = "get_slider_list()";
                    $btn = '<div class="btn-group">
                    <a data-id='.$row->id.' data-name='.$title.' data-subtitle='.$subtitle.' data-status='.$status.' data-photo='.$slider_photo.' data-type='.$type.' class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action','title','subtitle','slider_photo','status','type'])
                ->make(true);
        }

        return view('admin.slider.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        if($request->table_id)
        {
            $object=Slider::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Slider();
            $message = __('message.scc_msg.insert');
        }

        $object->title=$request->title;
        $object->subtitle=$request->subtitle;
        $object->type=$request->type;
        $object->status=$request->status;

        if ($object->save()) {
            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file($object->title.date('Y-m-d-H-i-s'),$file,'slider');
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
        $object = Slider::find($id);
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
