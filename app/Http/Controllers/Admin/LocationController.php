<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Str;
use DataTables;

class LocationController extends Controller
{
     public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Location::orderBy('id');
        }
        else
        {
            $items=Location::orderBy('created_at','desc');
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

                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){

                    $route_name="'location'";
                    $route_name_edit=route('admin.location.edit', $row->id);
                    $function_name = "get_location_list()";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','photo','description','order','status'])
                ->make(true);
        }
        return view('admin.location.index');
    }

    public function create()
    {
        return view('admin.location.create');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Location::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Location();
            $message = __('message.scc_msg.insert');
        }
        $object->name=$request->name;
        $object->slug=Str::slug($request->name);

        $object->map_link=$request->map_link;
        $object->description=$request->description??null;
        $object->status=$request->status;
        $object->order=$request->order;

        if ($object->save()) {

            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file(Str::random(20),$file,'location');
                if($path)
                {
                    $object->update([
                        'photo'=>$path,
                    ]);
                }
            }

            return redirect()->route('admin.location.index')->with('scc_msg',$message);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Location::find($id);
        return view('admin.location.edit',compact(['item']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = Location::find($id);
        $name = $object->name;

        $object->delete();
        $msg = __('message.scc_msg.delete');
        return response()->json([
            'success' => true,
            'message'=>$name.' '.$msg,
            'data'=>$object
        ]);

    }
}
