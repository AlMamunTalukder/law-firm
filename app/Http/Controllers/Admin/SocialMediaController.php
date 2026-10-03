<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{

    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=SocialMedia::orderBy('order');
        }
        else
        {
            $items=SocialMedia::all();
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return $row->icon;
                })
                ->addColumn('description', function($row){
                    $des = '';
                    if($row->important)
                    {
                        $des.='<span class="badge text-white bg-indigo-700">Important</span>';
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
                    $s_name="'".$row->icon."'";
                    $link="'".$row->link."'";
                    $status="'".$row->status."'";
                    $route_name="'socialmedia'";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-phone='.$link.' data-short_name='.$s_name.' data-status='.$status.'  class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','description','photo','status'])
                ->make(true);
        }
        return view('admin.settings.social_media');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=SocialMedia::find($request->table_id);
            $message = __('message.scc_msg.update');
        }

        $object->name=$request->name;
        $object->link=$request->link;
        $object->icon=$request->icon;
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

}
