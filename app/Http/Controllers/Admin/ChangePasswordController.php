<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function index()
    {
        return view('admin.settings.change_password');
    }

    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'current' => ['required', function ($attribute, $current, $fail) {
            if (!Hash::check($current, auth()->user()->password)) {
                $fail(__('message.password_mismatch'));
            }}],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user=User::find(auth()->user()->id);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);

        }
        if ($user->save()) {
            $msg = __('message.scc_msg.password_update');
            return redirect()->back()->with('scc_msg',$msg);
        }
    }
}
