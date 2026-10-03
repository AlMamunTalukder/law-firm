<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    protected $map = [
        'Notice' => \App\Models\Notice::class,
        'News' => \App\Models\News::class,
        'Member' => \App\Models\Member::class,
        'Slider' => \App\Models\Slider::class,
        'Feature' => \App\Models\Feature::class,
        'Ads' => \App\Models\Advertise::class,
        'Advertise' => \App\Models\Advertise::class,
        'Album' => \App\Models\Album::class,
        'Setting' => \App\Models\Setting::class,
        'Location' => \App\Models\Location::class,
        'Activity' => \App\Models\Activity::class,
    ];

    public function remove(Request $request)
    {
        $request->validate([
            'model' => 'required|string',
            'id' => 'required',
            'field' => 'required|string',
        ]);
        $modelKey = $request->model;
        $class = $this->map[$modelKey] ?? null;
        if(!$class) return response()->json(['success'=>false,'message'=>'Invalid model'], 422);
        $item = $class::find($request->id);
        if(!$item) return response()->json(['success'=>false,'message'=>'Not found'], 404);
        $field = $request->field;
        if(!isset($item->$field) || empty($item->$field)){
            return response()->json(['success'=>false,'message'=>'No file to delete'], 422);
        }
        $path = $item->$field;
        // delete from storage public
        if(Storage::disk('public')->exists($path)){
            Storage::disk('public')->delete($path);
        } else {
            // fallback file delete
            $full = storage_path('app/public/'.$path);
            if(File::exists($full)) File::delete($full);
        }
        // also delete thumbnail for album/image if exists
        if(str_contains($path, 'album/image/')){
            $thumb = str_replace('album/image/', 'album/image/thumbnails/', $path);
            if(Storage::disk('public')->exists($thumb)) Storage::disk('public')->delete($thumb);
        }
        $item->update([$field => null]);
        return response()->json(['success'=>true,'message'=>'File removed']);
    }
}
