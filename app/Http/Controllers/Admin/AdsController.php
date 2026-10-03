<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Section;
use App\Models\Advertise;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AdvertiseSection;
use App\Http\Controllers\Controller;

class AdsController extends Controller
{

    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Advertise::with(['sections'])->orderBy('id');
        }
        else
        {
            $items=Advertise::with(['sections']);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    if($row->photo)
                    {
                        $path = 'storage/'.$row->photo;
                        $img = '<img style="width:45px" src="'.asset($path).'" />';
                    }

                    return $img;
                })
                ->addColumn('description', function($row){
                    $description = '';
                    foreach ($row->sections as $key => $value) {
                        $description.='<span class="badge bg-indigo-700 text-white">'.$value->section->name.'</span> ';
                    }
                    return $description;
                })

                ->addColumn('status', function($row){
                    $status = '<span class="badge text-bg-warning">'.__('page.inactive').'</span>';
                    if ($row->status==1) {
                        $status = '<span class="badge text-bg-success">'.__('page.active').'</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function($row){

                    $route_name="'ads'";
                    $route_name_edit=route('admin.ads.edit', $row->id);
                    $function_name = "get_ads_list()";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','photo','description','order','status'])
                ->make(true);
        }
        $sections = Section::where('type',4)->get();
        return view('admin.ads.index',compact(['sections']));
    }

    public function create()
    {
        $sections = Section::where('type',4)->get();
        $sections = $sections->split(4);
        return view('admin.ads.create',compact(['sections']));
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Advertise::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Advertise();
            $message = __('message.scc_msg.insert');
        }
        $object->name=$request->name;
        $object->link=$request->link;
        $object->status=$request->status;

        if ($object->save()) {

            if($request->section_ids)
            {
                AdvertiseSection::where(['advertise_id'=>$object->id])->delete();
                foreach ($request->section_ids as $key => $value) {
                    $section_object = new AdvertiseSection();
                    $section_object->section_id = $value;
                    $section_object->advertise_id = $object->id;
                    $section_object->save();
                }
            }

            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file(Str::random(20),$file,'advertise');
                if($path)
                {
                    $object->update([
                        'photo'=>$path,
                    ]);
                }
            }

            return redirect()->route('admin.ads.index')->with('scc_msg',$message);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Advertise::with('sections')->find($id);
        $cat_sections = $item->sections->pluck('section_id')->toArray();
        $sections = Section::where('type',4)->get();
        $sections = $sections->split(4);
        return view('admin.ads.edit',compact(['sections','item','cat_sections']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = Advertise::find($id);
        $name = $object->name;
        AdvertiseSection::where(['advertise_id'=>$object->id])->delete();
        $object->delete();
        $msg = __('message.scc_msg.delete');
        return response()->json([
            'success' => true,
            'message'=>$name.' '.$msg,
            'data'=>$object
        ]);

    }
}
