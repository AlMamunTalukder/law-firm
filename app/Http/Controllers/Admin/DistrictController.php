<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $items=District::orderBy('code','asc')->with('division');
        if ($request->ajax()) {
            return Datatables::of($items)
            ->addIndexColumn()
            ->addColumn('short_name', function($row){
                return  $row->code;
            })
            ->addColumn('name', function($row){
                return $row->bn_name;
            })
            ->filterColumn('name', function($query, $keyword) {
                $sql = "bn_name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })

            ->addColumn('status', function($row){
                return $row->division->bn_name;
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->whereHas('division', fn($q) => $q->where('name','like', '%'.$keyword.'%'));
            })

            ->addColumn('action', function($row){
                $name="'".$row->bn_name."'";
                $s_name="'".$row->code."'";
                $division_id="'".$row->division_id."'";

                $route_name="'district'";
                $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-short_name='.$s_name.' data-division_id='.$division_id.'  class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                return $btn;
            })
            ->rawColumns(['action','short_name','status','name'])
            ->make(true);
        }

        return view('admin.website.other.district');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=District::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new District();
            $message = __('message.scc_msg.insert');
        }
        $object->division_id=$request->division_id;
        $object->bn_name=$request->name;
        $object->code=$request->code;
        if ($object->save()) {

            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message'=>$message,
                'data'=>$object
            ]);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object=District::find($id);
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
