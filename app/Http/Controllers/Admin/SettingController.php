<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $item = Setting::find(1);
        return view('admin.settings.basic', compact(['item']));
    }

    public function website_info()
    {
        $item = Setting::find(1);
        $latestNotices = \App\Models\Notice::where('status', 1)->orderByDesc('order')->orderByDesc('id')->take(5)->get();
        return view('admin.settings.website_info', compact(['item', 'latestNotices']));
    }

    public function website_info_update(Request $request)
    {
        $object = Setting::find(1);
        $object->teachers = $request->teachers;
        $object->male_students = $request->male_students;
        $object->female_students = $request->female_students;
        $object->alumni = $request->alumni;
        $object->staffs = $request->staffs;
        $object->donors = $request->donors;
        $object->email = $request->email;
        $object->phone = $request->phone;
        $object->donate = $request->donate;
        $object->about_title = $request->about_title;
        if ($request->filled('description')) {
            $object->about = $request->description;
        }

        if ($object->save()) {
            foreach (['about_center_image' => 'about', 'footer_connect_image' => 'footer', 'about_image' => 'about'] as $input => $folder) {
                $removeField = 'remove_' . $input;
                if ($request->has($removeField) && $request->$removeField == 1) {
                    if ($object->$input && \Storage::disk('public')->exists($object->$input)) \Storage::disk('public')->delete($object->$input);
                    $object->update([$input => null]);
                }
                if ($request->hasFile($input)) {
                    if ($object->$input && \Storage::disk('public')->exists($object->$input)) \Storage::disk('public')->delete($object->$input);
                    $file = $request->file($input);
                    $path = upload_file($input, $file, $folder);
                    if ($path) $object->update([$input => $path]);
                }
            }
        }

        return redirect()->route('admin.website_info.index')->with('success', 'Website info updated successfully');
    }

    public function update(Request $request)
    {
        $object = Setting::find(1);
        $object->name = $request->name;
        $object->phone = $request->phone;
        $object->copyright = $request->copyright;
        $object->short_name = $request->short_name;
        $object->title = $request->title;
        $object->meta_title = $request->meta_title;
        $object->meta_keyword = $request->meta_keyword;
        $object->meta_description = $request->meta_description;
        $object->bottom_carousel_title = $request->bottom_carousel_title;
        $object->footer_body_background_color = $request->footer_body_background_color;

        if ($object->save()) {
            foreach (['logo' => 'logo', 'favicon' => 'logo', 'admin_logo' => 'logo', 'footer_logo' => 'logo', 'scroll_top' => 'logo', 'banner' => 'logo'] as $input => $folder) {
                $removeField = 'remove_' . $input;
                if ($request->has($removeField) && $request->$removeField == 1) {
                    if ($object->$input && \Storage::disk('public')->exists($object->$input)) \Storage::disk('public')->delete($object->$input);
                    $object->update([$input => null]);
                }
                if ($request->hasFile($input)) {
                    if ($object->$input && \Storage::disk('public')->exists($object->$input)) \Storage::disk('public')->delete($object->$input);
                    $file = $request->file($input);
                    $path = upload_file($input, $file, $folder);
                    if ($path) $object->update([$input => $path]);
                }
            }
        }
        return redirect()->route('admin.setting.index')->with('success', 'Settings updated successfully');
    }
}
