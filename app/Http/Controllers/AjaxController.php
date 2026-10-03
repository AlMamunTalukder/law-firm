<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Area;
use App\Models\District;
use App\Models\ImageVideo;
use App\Models\Voting;
use App\Models\VotingCount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AjaxController extends Controller
{
    public function order_update(Request $request)
    {
    	$model_name = "App\Models\\".$request->table_model;
        $items= $model_name::all();

        foreach ($items as $item) {
            foreach ($request->order as $order) {
                if ($order['id'] == $item->id) {
                    $item->order=$order['position'];
                    $item->save();
                }
            }
        }

        return response()->json([
            'success' => true,
            'msg_title' => __('message.scc_title'),
            'message'=>__('message.reorder'),
        ]);
    }

    public function get_districts(Request $request)
    {
        $id = $request->id;
        $items = District::select('id','bn_name','code')->where(['division_id'=>$id])->get();
        if(!$items->isEmpty())
        {
            return response()->json([
                'success' => true,
                'data'=>$items,
                'msg_title' => __('message.scc_title'),
                'message'=>__('message.record_added'),
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'msg_title' => __('message.cancel_title'),
                'message'=>__('message.no_result_found'),
            ]);
        }
    }

    public function get_areas(Request $request)
    {
        $id = $request->id;
        $items = Area::select('id','bn_name','code')->where(['district_id'=>$id])->get();
        if(!$items->isEmpty())
        {
            return response()->json([
                'success' => true,
                'data'=>$items,
                'msg_title' => __('message.scc_title'),
                'message'=>__('message.record_added'),
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'msg_title' => __('message.cancel_title'),
                'message'=>__('message.no_result_found'),
            ]);
        }
    }

    public function seen_counter(Request $request,$id)
    {
        Album::findOrFail($id)->increment('total_view',1);
        return response()->json([
            'success' => true,
            'msg_title' => __('message.scc_title'),
        ]);
    }
    public function voting_submit(Request $request,$id)
    {
        $voting = Voting::findOrFail($id);
        $count_object = VotingCount::where(['voting_id'=>$voting->id])->first();
        if(!$count_object)
        {
            $count_object = new VotingCount();
            $count_object->voting_id = $voting->id;
            $count_object->option1_answer = 0;
            $count_object->option2_answer = 0;
            $count_object->option3_answer = 0;
            $count_object->save();
        }

        $column_name = 'option1_answer';

        if($request->option=='Red')
        {
            $column_name = 'option2_answer';
        }
        if($request->option=='Blue')
        {
            $column_name = 'option3_answer';
        }
        $mac = \Request::ip();
        $mac = $voting->id.''.$mac;

        VotingCount::where(['voting_id'=>$voting->id])->update([
            $column_name=>$count_object->$column_name + 1
        ]);
        Cookie::queue('voting', $mac, 2628000, '/', null, false, true);
        return response()->json([
            'success' => true,
            'msg_title' => __('message.scc_title'),
            'message'=>$request->all(),
        ]);
    }
}
