<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Writer;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\WriterDesignation;
use App\Http\Controllers\Controller;

class WriterController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Writer::with(['designations'])->orderBy('id');
        }
        else
        {
            $items=Writer::with(['designations']);
        }
        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    if($row->photo)
                    {
                        $path = 'storage/'.$row->photo;
                        $img = '<img style="width:45px" src="'.asset($path).'" />';
                    }

                    return $img;
                })

                ->addColumn('short_name', function($row){

                    return $row->name.''.($row->email?"<br/>".$row->email:'').''.($row->date_of_birth?"<br/>DOB: ".date('dS M,Y',strtotime($row->date_of_birth)):'');

                })
                ->addColumn('status', function($row){
                    $designations = '';
                    foreach ($row->designations as $key => $value) {
                        $designations.='<span class="badge text-bg-secondary">'.$value->designation->name.'</span>&nbsp;';
                    }
                    return $designations;

                })
                ->addColumn('action', function($row){
                    $name="'".$row->name."'";
                    $s_name="'".$row->email."'";
                    $phone_no="'".$row->phone."'";
                    $photo="'".$row->photo."'";
                    $designations="''";
                    if(!$row->designations->isEmpty())
                    {
                        $designations='';
                        foreach ($row->designations as $key => $value) {
                            $designations.=$value->designation->id.',';
                        }
                    }

                    $route_name="'writer'";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-photo='.$photo.' data-name='.$name.' data-short_name='.$s_name.' data-phone='.$phone_no.' data-designations='.$designations.' class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['name','action','short_name','status'])
                ->make(true);
        }
        $designations = select2_object(Designation::all());
        return view('admin.user_settings.writer',compact(['designations']));
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Writer::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Writer();
            $message = __('message.scc_msg.insert');
        }

        $object->name=$request->name;
        $object->email=$request->email;
        $object->phone=$request->phone_no;
        if ($object->save()) {
            WriterDesignation::where(['writer_id'=>$object->id])->delete();
            foreach ($request->designation_ids as $key => $value) {
                $obj_des = new WriterDesignation();
                $obj_des->writer_id = $object->id;
                $obj_des->designation_id = $value;
                $obj_des->save();
            }

            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file($object->name,$file,'writer');
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

    public function destroy(string $id)
    {
        $object=Writer::find($id);
        $name=$object->name;
        if ($object->delete()) {
            WriterDesignation::where(['writer_id'=>$id])->delete();
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
