<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Str;
use Spatie\Image\Image;
use Illuminate\Support\Facades\File;
class FeatureController extends Controller
{

    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Feature::orderBy('id');
        }
        else
        {
            $items=Feature::orderBy('name');
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    if($row->photo)
                    {
                        $path = asset('storage/'. $row->photo);
                        $img = '<img style="width:45px" src="'.$path.'?v='.md5_file(storage_path('app/public/' . $row->photo)).'" />';
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

                    $route_name="'feature'";
                    $route_name_edit=route('admin.feature.edit', [$row->id]);
                    $function_name = "get_feature_list('".$row->id."')";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['photo','action','status'])
                ->make(true);
        }

        return view('admin.feature.index');
    }

    public function create()
    {
        return view('admin.feature.create');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Feature::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Feature();
            $object->slug = Str::random(15);

            $message = __('message.scc_msg.insert');
        }
        $object->name = $request->name;
        $object->link = $request->link;
        $object->order = $request->order;
        $object->status = $request->status;

        if ($object->save()) {
            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file($object->slug,$file,'feature');
                if($path)
                {
                    $object->update([
                        'photo'=>$path,
                    ]);
                }

            }
            return redirect()->route('admin.feature.index')->with('scc_msg',$message);
        }

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Feature::find($id);

        return view('admin.feature.edit',compact('item'));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = Feature::find($id);
        $name = $object->name;
        $photo=$object->photo;
        $object->delete();
        $msg = __('message.scc_msg.delete');
        File::delete(storage_path('app/public/'.$photo));

        return response()->json([
            'success' => true,
            'message'=>$name.' '.$msg,
            'data'=>$object
        ]);
    }
}
