<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Role::orderBy('id');
        }
        else
        {
            $items=Role::all();
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return $row->created_at?date('dS M,y',strtotime($row->created_at)):'';
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
                    $route_name="'role'";
                    $assign_permission_route=route('admin.assign_permission_to_role.index', $row->id);
                    $btn = '<div class="btn-group"><a href='.$assign_permission_route.' class="btn bg-indigo-700 btn-xs text-white">Assign Permission to Role</a><a data-id='.$row->id.' data-name='.$name.'  data-status='.$status.'  class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','status'])
                ->make(true);
        }
        return view('admin.user_settings.role_permission.role');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Role::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Role();
            $message = __('message.scc_msg.insert');
        }
        $object->name=$request->name;
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
        $object=Role::find($id);

        if(!$object->permissions->isEmpty())
        {
            $msg = __('message.cancel_delete');
            return response()->json([
                'success' => false,
                'msg_title' => __('message.cancel_title'),
                'message'=>$msg,
                'data'=>$object
            ]);
        }
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

    public function assign_permission ($role_id)
    {
        $item = Role::find($role_id);
        $has_permissions = $item->permissions;
        $permissions = Permission::with(['permission_feature'])->get()->groupBy('permission_feature_id');

        return view('admin.user_settings.role_permission.assign_permission',compact(['has_permissions','item','permissions']));
    }

    public function assign_permission_submit(Request $request,$role_id)
    {
        $item = Role::find($role_id);

        $item->syncPermissions($request->permissions);
        $msg = __('message.scc_msg.update');
        return redirect()->back()->with('scc_msg','Permissions assign to "'.$item->name.'" role '.$msg);
    }
}
