<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $items=Area::orderBy('code','asc')->with('district');
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
                return $row->district->bn_name;
            })
            ->filterColumn('status', function($query, $keyword) {
                $query->whereHas('district', fn($q) => $q->where('name','like', '%'.$keyword.'%'));
            })

            ->addColumn('action', function($row){
                $name="'".$row->bn_name."'";
                $s_name="'".$row->code."'";
                $district_id="'".$row->district_id."'";

                $route_name="'area'";
                $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-short_name='.$s_name.' data-district_id='.$district_id.'  class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                return $btn;
            })
            ->rawColumns(['action','short_name','status','name'])
            ->make(true);
        }

        return view('admin.website.other.area');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Area::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Area();
            $message = __('message.scc_msg.insert');
        }
        $object->district_id=$request->district_id;
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
        $object=Area::find($id);
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
