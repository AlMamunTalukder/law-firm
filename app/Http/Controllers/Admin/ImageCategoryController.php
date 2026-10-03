<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Section;
use App\Models\Category;
use App\Models\ImageVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageCategoryController extends Controller
{

    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Category::where('type',2)->whereNull('category_id')->orderByDesc('order');
        }
        else
        {
            $items=Category::where('type',2)->whereNull('category_id');
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return $row->slug;
                })

                ->addColumn('order', function($row){
                    return $row->order;
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
                    $s_name="'".$row->slug."'";
                    $order="'".$row->order."'";
                    $status="'".$row->status."'";
                    $route_name="'imagecategory'";
                    $route_name_edit=route('admin.category.edit', $row->id);
                    $btn = '<div class="btn-group"><a data-id='.$row->id.' data-name='.$name.' data-order='.$order.' data-short_name='.$s_name.' data-status='.$status.' class="edit_modal btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-table="common"  class="delete_record btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','description','order','status'])
                ->make(true);
        }
        return view('admin.imagevideo.category');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=Category::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new Category();
            $message = __('message.scc_msg.insert');
        }

        $object->name=$request->name;
        $object->slug =$request->slug;
        if($request->slug && $request->slug=='')
        {
            $object->slug = createSlug('\category',$object->name);
        }
        $object->icon=$request->icon;
        $object->type=$request->type;
        $object->status=$request->status;
        $object->order=$request->order;

        $object->meta_title=$request->meta_title;
        $object->meta_keyword=$request->meta_keyword;
        $object->meta_description=$request->meta_description;

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
        $item = Category::with('sections')->find($id);
        $cat_sections = $item->sections->pluck('section_id')->toArray();
        $sections = Section::where('type',2)->get();
        return view('admin.category.edit',compact(['sections','item','cat_sections']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = Category::find($id);
        $name = $object->name;

        $exist = ImageVideo::where(['category_id'=>$object->id])->get();
        if(!$exist->isEmpty())
        {
            $msg = __('message.scc_msg.cancel_delete');
            return response()->json([
                'success' => false,
                'msg_title' => __('message.cancel_title'),
                'message'=>$name.' '.$msg,
                'data'=>$object
            ]);
        }
        else
        {
            $object->delete();
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'message'=>$name.' '.$msg,
                'data'=>$object
            ]);
        }

    }
}
