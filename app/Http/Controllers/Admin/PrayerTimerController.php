<?php

namespace App\Http\Controllers\Admin;

use App\Models\PrayerTimer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class PrayerTimerController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=PrayerTimer::orderBy('order');
        }
        else
        {
            $items=PrayerTimer::all();
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return date('h:i a',strtotime($row->timing));
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
                    $status = '<span class="badge text-bg-warning">অন্যান্য সময়</span>';
                    if ($row->type==1) {
                        $status = '<span class="badge text-bg-success">৫ ওয়াক্ত সালাত</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){
                    $name="'".$row->name."'";
                    $time="'".$row->timing."'";
                    $link="'".$row->type."'";
                    $status="'".$row->status."'";
                    $route_name="'PrayerTimer'";
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-phone='.$link.' data-time='.$time.' data-status='.$status.'  class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','description','photo','status'])
                ->make(true);
        }
        return view('admin.settings.prayer_timer');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=PrayerTimer::find($request->table_id);
            $message = __('message.scc_msg.update');
        }

        $object->name=$request->name;
        $object->timing=$request->timing;
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
