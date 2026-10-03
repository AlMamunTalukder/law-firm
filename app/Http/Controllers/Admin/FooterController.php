<?php

namespace App\Http\Controllers\Admin;

use App\Models\Footer;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
{

    public function index()
    {
        $items = Section::where(['type'=>3])->get();
        return view('admin.footer.index',compact(['items']));
    }

    public function edit(string $section_id)
    {
        $item  = Section::find($section_id);
        $items = Footer::where(['section_id'=>$section_id])->get();
        return view('admin.footer.edit',compact(['item','items']));

    }

    public function update(Request $request, string $id)
    {
        Footer::where(['section_id'=>$id])->delete();
        if($request->type==2 && $request->description && ($request->description!='' || $request->description==null))
        {
            $object = new Footer();
            $object->section_id = $id;
            $object->name = $request->description;
            $object->type = $request->type;
            $object->save();
        }
        else
        {
            foreach ($request->name as $key => $value) {
                $object = new Footer();
                $object->section_id = $id;
                $object->name = $value;
                $object->link = $request->link[$key];
                $object->type = $request->type;
                $object->save();
            }
        }
        $section = Section::find($id);
        $msg = __('message.scc_msg.update');
        return redirect()->route('admin.footer.edit',$id)->with('scc_msg',$section->name.' footer widget '.$msg);
    }

    public function destroy(string $id)
    {

    }
}
