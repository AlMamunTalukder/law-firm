<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\News;
use App\Models\Writer;
use App\Models\Section;
use Spatie\Image\Image;
use App\Models\Category;
use App\Models\NewsSection;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\UserCategoryPermission;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column']==0) {

            $items=News::with(['categories','sections'])->orderByDesc('action_date')->orderByDesc('id');
        }
        else
        {
            $items=News::with(['categories','sections']);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('photo', function($row){
                    $img = '<img style="width:45px" src="'.asset('default.jpg').'" />';
                    if($row->photo)
                    {
                        $path = asset('storage/'. ($row->photo??''));
                        $img = '<img style="width:45px" src="'.$path.'" />';
                    }

                    return $img;
                })
                ->addColumn('category', function($row){
                    $category = '';
                    foreach ($row->categories as $key => $value) {
                        $category.='<span class="badge bg-teal-700 text-white">'.($value->category->name ?? '—').'</span> ';
                    }
                    return $category;
                })

                ->filterColumn('category', function($query, $keyword) {
                    $query->whereHas('categories', fn($q) => $q->whereHas('category',fn($q2)=>$q2->where('name','like', '%'.$keyword.'%')));
                })
                ->addColumn('date', function($row){
                    return date('dS M,y',strtotime($row->action_date));
                })

                ->addColumn('description', function($row){
                    $description = '';
                    foreach ($row->sections as $key => $value) {
                        $description.='<span class="badge bg-indigo-700 text-white">'.($value->section->name??'').'</span> ';
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

                    $route_name="'news'";
                    $route_name_edit=route('admin.news.edit', $row->id);
                    $function_name = "get_news_list()";
                    $btn = '<div class="btn-group"><a href="'.$route_name_edit.'" class="btn-info btn btn-xs text-white">'.__('page.edit').'</a><a href="javascript:void(0)" data-id='.$row->id.' data-route='.$route_name.' data-fname='.$function_name.'  class="delete_record_specific btn-danger btn btn-xs ">'.__('page.delete').'</a></div>';
                    return $btn;
                })
                ->rawColumns(['photo','action','category','description','date','status'])
                ->make(true);
        }

        return view('admin.news.index');
    }

    public function create()
    {
        $sections = Section::where('type',1)->get();
        $cat_assigns = UserCategoryPermission::whereHas('category',fn($q)=>$q->where('type',1))->where('user_id',auth()->user()->id)->get();
        if($cat_assigns->isEmpty())
        {
            $categories = select2_object(Category::where('type',1)->whereNull('category_id')->get());
        }
        else
        {
            $categories = select2_object(Category::where('type',1)->whereIn('id',$cat_assigns->pluck('category_id')->toArray())->whereNull('category_id')->get());
        }
        $writers = select2_object(Writer::all());
        return view('admin.news.create',compact(['sections','categories','writers']));
    }

    public function store(Request $request)
    {
        if($request->table_id)
        {
            $object=News::find($request->table_id);
            $message = __('message.scc_msg.update');
        }
        else{
            $object=new News();
            $object->slug = Str::random(15);

            $message = __('message.scc_msg.insert');
        }
        $object->name = $request->name;
        $object->top_title = $request->top_title;
        $object->bottom_title = $request->bottom_title;
        $object->action_date = $request->action_date;
        $object->description = $request->description;

        $object->division_id = $request->division_id;
        $object->district_id = $request->district_id;
        $object->area_id = $request->area_id;

        $object->meta_title = $request->meta_title;
        $object->meta_keyword = $request->meta_keyword;
        $object->meta_description = $request->meta_description;
        $object->writer_id = $request->writer_id;
        $object->show_in_home = $request->show_in_home;
        $object->order = $request->order;

        $object->status = $request->status;
        $object->user_id = auth()->user()->id;

        if ($object->save()) {
            NewsCategory::where(['news_id'=>$object->id])->delete();
            if($request->category_id)
            {

                $cat_object = new NewsCategory();
                $cat_object->category_id = $request->category_id;
                $cat_object->news_id = $object->id;
                $cat_object->save();
                if($request->subcategory_id)
                {
                    $cat_object = new NewsCategory();
                    $cat_object->category_id = $request->subcategory_id;
                    $cat_object->news_id = $object->id;
                    $cat_object->save();
                }
            }
            NewsSection::where(['news_id'=>$object->id])->delete();
            if($request->section_ids)
            {

                foreach ($request->section_ids as $key => $value) {
                    $section_object = new NewsSection();
                    $section_object->section_id = $value;
                    $section_object->news_id = $object->id;
                    $section_object->save();
                }
            }

            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $path = upload_file($object->slug,$file,'news');
                if($path)
                {
                    $object->update([
                        'photo'=>$path,
                    ]);
                }

            }
            return redirect()->route('admin.news.index')->with('scc_msg',$message);
        }

    }

    public function show(string $id)
    {

    }

    public function edit(string $id)
    {
        $item = News::with(['categories','sections'])->find($id);
        $sections = Section::where('type',1)->get();
        $cat_assigns = UserCategoryPermission::whereHas('category',fn($q)=>$q->where('type',1))->where('user_id',auth()->user()->id)->get();
        if($cat_assigns->isEmpty())
        {
            $categories = select2_object(Category::where('type',1)->whereNull('category_id')->get());
        }
        else
        {
            $categories = select2_object(Category::where('type',1)->whereIn('id',$cat_assigns->pluck('category_id')->toArray())->whereNull('category_id')->get());
        }
        $sub_categories = select2_object(Category::where('type',1)->whereNotNull('category_id')->get());
        $writers = select2_object(Writer::all());
        $selected_cat = [];
        $selected_subcat = [];
        if (!$item->categories->isEmpty()) {
            $selected_cat = $item->categories->whereNull('category.category_id')->pluck('category_id')->toArray()[0];
            $selected_subcategories = $item->categories->whereNotNull('category.category_id');
            $selected_subcat =(!$selected_subcategories->isEmpty())?$selected_subcategories->pluck('category_id')->toArray()[0]:[];
        }

        return view('admin.news.edit',compact(['writers','selected_cat','selected_subcat','sections','categories','item','sub_categories']));
    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {
        $object = News::find($id);
        $name = $object->name;
        $user_id = $object->user_id;
        if(auth()->user()->id != $user_id)
        {
            $msg = __('message.scc_msg.cancel_delete');
            return response()->json([
                'success' => true,
                'message'=>'নিউজ ডিলিট করার অনুমোদন নেই',
                'data'=>$object
            ]);
        }

        else
        {
            NewsSection::where(['news_id'=>$object->id])->delete();
            NewsCategory::where(['news_id'=>$object->id])->delete();
            $object->delete();
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'message'=>$name.' '.$msg,
                'data'=>$object
            ]);
        }
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::load($path)->resize($width, $height);
        $img->quality(60)->optimize()->save($path);
    }
}
