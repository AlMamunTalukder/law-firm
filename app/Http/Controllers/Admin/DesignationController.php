<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class DesignationController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Designation::orderBy('id');
        }
        else
        {
            $items=Designation::all();
        }
        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    if ($row->type==1) {
                        return '<span class="badge text-bg-success">Management</span>';
                    }
                    if ($row->type==2) {
                        return '<span class="badge text-bg-info text-white">Advocate</span>';
                    }
                    if ($row->type==3) {
                        return '<span class="badge text-bg-primary">Staff</span>';
                    }

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
                    $s_name="'".$row->type."'";
                    $status="'".$row->status."'";;
                    $route_name="'designation'";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-designation_type='.$s_name.' data-status='.$status.' class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','status'])
                ->make(true);
        }
        return view('admin.member.designation');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Designation::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Designation();
            $message = __('message.scc_msg.insert');
        }

        $object->name=$request->name;
        $object->type=$request->designation_type;
        $object->status=$request->status;

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
        $object=Designation::find($id);
        $name=$object->name;
        if ($object->delete()) {
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
