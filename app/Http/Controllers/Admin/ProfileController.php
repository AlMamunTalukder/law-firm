<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        $item = User::find(auth()->user()->id);
        return view('admin.settings.profile',compact(['item']));
    }

    public function update(Request $request)
    {
        $object = User::find(auth()->user()->id);
        $object->name = $request->name;
        $object->email = $request->email;
        $object->save();

        $msg = __('message.scc_msg.update');
        return redirect()->back()->with('scc_msg',$msg);;
    }
}
