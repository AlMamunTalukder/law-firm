<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Spatie\Image\Image;
use App\Models\Category;
use App\Models\ImageVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\UserCategoryPermission;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    public function index(Request $request)
    {

        if (!$request['order'] || $request['order'][0]['column'] == 0) {

            $items = ImageVideo::with('category')->where('type', 1)->orderBy('created_at');
        } else {
            $items = ImageVideo::with('category')->where('type', 1);
        }

        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('short_name', function ($row) {
                    return $row->slug;
                })
                ->addColumn('photo', function ($row) {
                    $img = '<img style="width:45px" src="' . asset('default.jpg') . '" />';
                    if ($row->photo) {
                        $path = 'storage/' . $row->photo;
                        $img = '<img style="width:45px" src="' . asset($path) . '" />';
                    }

                    return $img;
                })
                ->addColumn('description', function ($row) {
                    $des = '';
                    if ($row->important) {
                        $des .= '<span class="badge text-white bg-indigo-700">Slider Image</span>';
                    }
                    return $des;
                })
                ->addColumn('status', function ($row) {
                    $status = '<span class="badge text-bg-warning">' . __('page.inactive') . '</span>';
                    if ($row->status == 1) {
                        $status = '<span class="badge text-bg-success">' . __('page.active') . '</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($row) {
                    $name = "'" . $row->name . "'";
                    $s_name = "'" . $row->category_id . "'";
                    $photo = "'" . $row->photo . "'";
                    $status = "'" . $row->status . "'";
                    $important = "'" . $row->important . "'";
                    $sticky_image = "'" . $row->sticky_image . "'";
                    $block_image = "'" . $row->block_image . "'";
                    $route_name = "'image'";
                    $function_name = "get_image_video_list('image')";
                    $btn = '<div class="btn-group"><a data-id=' . $row->id . ' data-name=' . $name . ' data-short_name=' . $s_name . ' data-status=' . $status . ' data-important=' . $important . ' data-sticky=' . $sticky_image . ' data-block=' . $block_image . ' data-photo=' . $photo . ' class="edit_modal btn-info btn btn-xs text-white">' . __('page.edit') . '</a><a href="javascript:void(0)" data-id=' . $row->id . ' data-route=' . $route_name . ' data-fname=' . $function_name . '  class="delete_record_specific btn-danger btn btn-xs ">' . __('page.delete') . '</a></div>';
                    return $btn;
                })
                ->rawColumns(['action', 'short_name', 'description', 'photo', 'status'])
                ->make(true);
        }

        $cat_assigns = UserCategoryPermission::whereHas('category', fn($q) => $q->where('type', 3))->where('user_id', auth()->user()->id)->get();

        if ($cat_assigns->isEmpty()) {
            $categories = select2_object(Category::where('type', 3)->get());
        } else {
            $categories = select2_object(Category::where('type', 3)->whereIn('id', $cat_assigns->pluck('category_id')->toArray())->get());
        }

        return view('admin.imagevideo.image', compact(['categories']));
    }

    public function create() {}

    public function store(Request $request)
    {

        if ($request->table_id) {
            $object = ImageVideo::find($request->table_id);
            $message = __('message.scc_msg.update');
        } else {
            $object = new ImageVideo();
            $message = __('message.scc_msg.insert');
        }

        $object->name = $request->name;
        $object->category_id = $request->category_id;
        $object->type = $request->type;
        $object->status = $request->status;
        $object->important = $request->important;
        $object->sticky_image = $request->sticky;
        $object->block_image = $request->block;

        if ($object->save()) {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $path = upload_file($object->name, $file, 'image');
                if ($path) {
                    $object->update([
                        'photo' => $path,
                    ]);
                }

            }
            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message' => $message,
                'data' => $object
            ]);
        }
    }

    public function destroy(string $id)
    {
        $object = ImageVideo::find($id);
        $name = $object->name;
        $photo = $object->photo;
        if ($object->delete()) {
            File::delete(storage_path('app/public/' . $photo));
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'message' => $name . ' ' . $msg,
                'data' => $object
            ]);
        }
    }
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::load($path)->resize($width, $height);
        $img->save($path);
    }
}
