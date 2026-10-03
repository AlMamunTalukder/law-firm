<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Role;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\UserCategoryPermission;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=User::orderBy('id');
        }
        else
        {
            $items=User::all();
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('type', function($row){
                    $type = '';

                    foreach ($row->roles as $key => $value) {
                        $type.='<span class="badge bg-teal-700">'.$value->name.'</span> ';
                    }

                    return $type;
                })

                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $route_name="'user'";
                    $route_edit=route('admin.user.edit', $row->id);
                    $route_assign_news_cat=route('admin.assigncategory.index', ['1',$row->id]);
                    $route_assign_image_cat=route('admin.assigncategory.index', ['2',$row->id]);
                    $btn = '<div class="btn-group"><a href="'.$route_assign_news_cat.'" class="bg-indigo-700 btn btn-xs text-white">Assign News Category</a><a href="'.$route_assign_image_cat.'" class="bg-cyan-700 btn btn-xs text-white">Assign Image/Video Category</a><a href="'.$route_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','type','status'])
                ->make(true);
        }
        return view('admin.user_settings.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user_settings.create',compact(['roles']));
    }

    public function edit($id)
    {
        $item = User::find($id);
        $roles = Role::all();
        return view('admin.user_settings.edit',compact(['item','roles']));
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=User::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new User();
            $message = __('message.scc_msg.insert');
        }
        $object->name=$request->name;
        $object->email=$request->email;
        $object->password=Hash::make($request->password);
        if ($object->save()) {
            $object->syncRoles($request->roles);
            return redirect()->route('admin.user.index')->with(['scc_msg',$message]);
        }
    }

    public function destroy(string $id)
    {
        $object=User::with('permissions')->find($id);

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

    public function assign_category_user($type_id,$user_id)
    {
        $item = User::find($user_id);
        $user_categories = UserCategoryPermission::where('user_id',$user_id)->whereHas('category',fn($q)=>$q->where('type',$type_id)->whereNull('category_id'))->get();
        $categories = Category::where(['type'=>$type_id])->whereNull('category_id')->get();
        return view('admin.user_settings.assign_category',compact(['type_id','item','categories','user_categories']));
    }

    public function assign_category(Request $request,$type_id,$user_id)
    {
        UserCategoryPermission::where(['user_id'=>$user_id])->delete();
        foreach ($request->categories as $key => $value) {
            $object = new UserCategoryPermission();
            $object->user_id = $user_id;
            $object->category_id = $value;
            $object->save();
        }
        $message = __('message.scc_msg.update');
        return redirect()->route('admin.assigncategory.index',[$type_id,$user_id])->with(['scc_msg',$message]);
    }
}
