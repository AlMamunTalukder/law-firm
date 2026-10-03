<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionFeature;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Permission::with(['permission_feature'])->orderBy('id');
        }
        else
        {
            $items=Permission::with(['permission_feature']);
        }
        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return $row->permission_feature->name;
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
                    $status="'".$row->status."'";
                    $route_name="'permission'";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.'  data-status='.$status.'  class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','status'])
                ->make(true);
        }
        $permission_features = select2_object(PermissionFeature::all());
        return view('admin.user_settings.role_permission.permission',compact(['permission_features']));
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Permission::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Permission();
            $message = __('message.scc_msg.insert');
        }
        $object->name=$request->name;
        $object->permission_feature_id=$request->permission_feature_id;
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
        $object=Permission::find($id);

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
