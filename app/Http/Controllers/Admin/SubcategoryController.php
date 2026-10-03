<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\News;
use App\Models\Section;
use App\Models\Category;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Models\SectionCategory;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=Category::with(['sections','category'])->where('type',1)->whereNotNull('category_id')->orderBy('order');
        }
        else
        {
            $items=Category::with(['sections','category'])->where('type',1)->whereNotNull('category_id');
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function($row){
                    return $row->slug;
                })

                ->addColumn('cat_name', function($row){
                    return $row->category?$row->category->name:'';
                })

                ->addColumn('description', function($row){
                    $description = '';
                    foreach ($row->sections as $key => $value) {
                        if($value->section){
                            $description.='<span class="badge bg-indigo-700 text-white">'.$value->section->name.'</span> ';
                        }
                    }
                    return $description;
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

                    $route_name="'subcategory'";
                    $route_name_edit=route('admin.subcategory.edit', $row->id);
                    $function_name = "get_subcategory_list()";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['action','short_name','cat_name','description','order','status'])
                ->make(true);
        }
        $sections = Section::where('type',2)->get();
        return view('admin.category.subcategory.index',compact(['sections']));
    }

    public function create()
    {
        $sections = Section::where('type',2)->get();
        $news_list = select2_object(News::all());
        $categories = select2_object(Category::whereNull('category_id')->where('type',1)->orderBy('order')->get());
        return view('admin.category.subcategory.create',compact(['sections','categories','news_list']));
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
        $object->category_id =$request->category_id;
        if($request->slug && $request->slug=='')
        {
            $object->slug = createSlug('\category',$object->name);
        }
        $object->type=$request->type;
        $object->icon=$request->icon;
        $object->status=$request->status;
        $object->order=$request->order;
        $object->is_single_news=$request->is_single_news;
        $object->news_url=$request->news_url;

        $object->meta_title=$request->meta_title;
        $object->meta_keyword=$request->meta_keyword;
        $object->meta_description=$request->meta_description;

        if ($object->save()) {

            SectionCategory::where(['category_id'=>$object->id])->delete();
            if($request->section_ids)
            {
                foreach ($request->section_ids as $key => $value) {
                    $section_object = new SectionCategory();
                    $section_object->section_id = $value;
                    $section_object->category_id = $object->id;
                    $section_object->save();
                }
            }

            return redirect()->route('admin.subcategory.index')->with('scc_msg',$message);
        }
    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = Category::with(['sections','category'])->find($id);
        $cat_sections = $item->sections->pluck('section_id')->toArray();
        $sections = Section::where('type',2)->get();
        $categories = select2_object(Category::whereNull('category_id')->where('type',1)->orderBy('order')->get());
        $news_list = select2_object(News::all());
        return view('admin.category.subcategory.edit',compact(['sections','item','cat_sections','categories','news_list']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = Category::find($id);
        $name = $object->name;

        $exist = NewsCategory::where(['category_id'=>$object->id])->get();
        if(!$exist->isEmpty())
        {
            $msg = __('message.scc_msg.cancel_delete');
            return response()->json([
                'success' => true,
                'message'=>$name.' '.$msg,
                'data'=>$object
            ]);
        }
        else
        {
            SectionCategory::where(['category_id'=>$object->id])->delete();
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
