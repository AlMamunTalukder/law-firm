<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{

    public function index(Request $request)
    {
        $items = Division::orderBy('code', 'asc');
        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function ($row) {
                    return  $row->code;
                })
                ->addColumn('name', function ($row) {
                    return $row->bn_name;
                })

                ->addColumn('status', function ($row) {
                    return '<span class="badge text-bg-success">' . __('page.active') . '</span>';
                })

                ->addColumn('action', function ($row) {
                    $name = "'" . $row->bn_name . "'";
                    $s_name = "'" . $row->code . "'";

                    $route_name = "'division'";
                    $btn = '<div class="btn-group"><a data-id=' . $row->id . ' data-name=' . $name . ' data-short_name=' . $s_name . '  class="edit_modal btn-info btn btn-xs text-white">' . __('page.edit') . '</a><a href="javascript:void(0)" data-id=' . $row->id . ' data-route=' . $route_name . ' data-table="common"  class="delete_record btn-danger btn btn-xs ">' . __('page.delete') . '</a></div>';
                    return $btn;
                })
                ->rawColumns(['action', 'short_name', 'status', 'name'])
                ->make(true);
        }

        return view('admin.website.other.division');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        if ($request->table_id) {
            $object = Division::find($request->table_id);
            $message = __('message.scc_msg.update');
        } else {
            $object = new Division();
            $message = __('message.scc_msg.insert');
        }
        $object->bn_name = $request->name;
        $object->code = $request->code;
        if ($object->save()) {

            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message' => $message,
                'data' => $object
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
        $object = Division::find($id);
        $name = $object->name;
        if ($object->delete()) {
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message' => $msg,
                'data' => $object
            ]);
        }
    }
}
