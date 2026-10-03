<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Voting;
use App\Models\VotingCount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VotingController extends Controller
{
    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Voting::with(['voting_count'])->orderByDesc('action_date');
        }
        else
        {
            $items=Voting::with(['voting_count']);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()

                ->addColumn('description', function($row){
                    $description = '';
                    $description.=$row->option1.'='.($row->voting_count?$row->voting_count->option1_answer:0).'; ';
                    $description.=$row->option2.'='.($row->voting_count?$row->voting_count->option2_answer:0).'; ';
                    $description.=$row->option3.'='.($row->voting_count?$row->voting_count->option3_answer:0).'';
                    return $description;
                })

                ->addColumn('date', function($row){
                    return date('dS M, y',strtotime($row->action_date));
                })
                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){

                    $route_name="'voting'";
                    $route_name_edit=route('admin.voting.edit', $row->id);
                    $function_name = "get_voting_list()";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','description','date','status'])
                ->make(true);
        }
        return view('admin.voting.index');
    }

    public function create()
    {
        return view('admin.voting.create');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Voting::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Voting();
            $message = __('message.scc_msg.insert');
        }

        $object->name=$request->name;
        $object->option1=$request->option1;
        $object->option2=$request->option2;
        $object->option3=$request->option3;
        $object->action_date =$request->action_date;
        $object->status =$request->status;
        if ($object->save()) {
            return redirect()->route('admin.voting.index')->with('scc_msg',$message);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Voting::with('voting_count')->find($id);
        return view('admin.voting.edit',compact(['item']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = Voting::find($id);
        $name = $object->name;
        $object->delete();
        $msg = __('message.scc_msg.delete');
        return response()->json([
            'success' => true,
            'message'=>$name.' '.$msg,
            'data'=>$object
        ]);

    }
}
