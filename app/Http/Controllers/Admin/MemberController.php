<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Member;
use Spatie\Image\Image;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\MemberDesignation;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        if (!$request['order'] || $request['order'][0]['column'] == 0) {

            $items = Member::with(['designations'])->orderBy('code');
        } else {
            $items = Member::with(['designations']);
        }
        if ($request->ajax()) {
            return Datatables::of($items)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $img = '<img style="width:45px" src="' . asset('default.jpg') . '" />';
                    if ($row->photo) {
                        $path = 'storage/' . $row->photo;
                        $img = '<img style="width:45px" src="' . asset($path) . '" />';
                    }

                    return $img;
                })

                ->addColumn('short_name', function ($row) {

                    return $row->name . '' . ($row->email ? "<br/>" . $row->email : '') . '' . ($row->date_of_birth ? "<br/>DOB: " . date('dS M,Y', strtotime($row->date_of_birth)) : '');

                })
                ->addColumn('status', function ($row) {
                    $designations = '';
                    foreach ($row->designations as $key => $value) {
                        $designations .= '<span class="badge text-bg-secondary">' . ($value->designation->name ?? '—') . '</span>&nbsp;';
                    }
                    return $designations;

                })
                ->addColumn('action', function ($row) {

                    $route_name = "'member'";
                    $route_edit = route('admin.member.edit', $row->id);
                    $btn = '<div class="btn-group"><a href="' . $route_edit . '" class="btn-info btn btn-xs text-white">' . __('page.edit') . '</a><a href="javascript:void(0)" data-id=' . $row->id . ' data-route=' . $route_name . ' data-table="common"  class="delete_record btn-danger btn btn-xs ">' . __('page.delete') . '</a></div>';
                    return $btn;
                })
                ->rawColumns(['name', 'action', 'short_name', 'status'])
                ->make(true);
        }

        return view('admin.member.members');
    }

    public function create()
    {
        $designations = select2_object(Designation::all());
        return view('admin.member.create', compact(['designations']));
    }

    public function edit($id)
    {
        $item = Member::find($id);
        $designations = select2_object(Designation::all());
        $member_designation = MemberDesignation::where(['member_id' => $id])->get()->pluck('designation_id')->toArray();

        return view('admin.member.edit', compact(['item', 'designations', 'member_designation']));
    }

    public function store(Request $request)
    {

        \Log::info('REQUEST DATA:', $request->all());
        \Log::info('FILES:', $request->allFiles());

        if ($request->table_id) {
            $object = Member::find($request->table_id);
            $message = __('message.scc_msg.update');
        } else {
            $object = new Member();
            $message = __('message.scc_msg.insert');
        }

        $object->name = $request->name;
        $object->email = $request->email;
        $object->phone_no = $request->phone_no;
        $object->date_of_birth = $request->date_of_birth;
        $object->description = $request->description;
        $object->facebook = $request->facebook;
        $object->twitter = $request->twitter;
        $object->linkedin = $request->linkedin;
        $object->slug = make_slug($request->name);

        if ($object->save()) {
            MemberDesignation::where(['member_id' => $object->id])->delete();
            if ($request->designation_ids) {
                foreach ($request->designation_ids as $value) {
                    $obj_des = new MemberDesignation();
                    $obj_des->member_id = $object->id;
                    $obj_des->designation_id = $value;
                    $obj_des->save();
                }
            }

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');

                \Log::info('FILE DETAILS:', [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime' => $file->getMimeType(),
                    'error' => $file->getError()
                ]);

                $filename = \Illuminate\Support\Str::slug($object->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('member', $filename, 'public');

                \Log::info('STORED PATH: ' . $path);

                if ($path) {
                    $object->update(['photo' => $path]);
                    \Log::info('PHOTO UPDATED IN DB: ' . $path);
                } else {
                    \Log::error('FAILED TO STORE PHOTO');
                }
            } else {
                \Log::info('NO PHOTO IN REQUEST');
            }

            return redirect()->route('admin.member.index')->with('scc_msg', $message);
        }
    }

    public function destroy(string $id)
    {
        $object = Member::findOrFail($id);
        $name = $object->name;
        if ($object->delete()) {
            MemberDesignation::where(['member_id' => $id])->delete();
            $msg = __('message.scc_msg.delete');
            return response()->json([
                'success' => true,
                'msg_title' => __('message.scc_title'),
                'message' => $msg,
                'data' => $object
            ]);
        }
    }
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::load($path)->resize($width, $height);
        $img->quality(60)->optimize()->save($path);
    }
};
