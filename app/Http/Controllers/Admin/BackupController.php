<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Session;
class BackupController extends Controller
{
    public function index()
  {
    $path = storage_path('app/public/backup');
    if (! File::exists($path)) {
      File::makeDirectory($path);
    }

    $files = File::files($path);
    $manuals = [];
    foreach($files as $path)
    {
      $manuals[] = pathinfo($path);
    }
    $manuals=array_reverse($manuals);
    return view('admin.settings.backup_list')->with(['files'=>$manuals]);
  }

  public function store()
  {
    \Artisan::call('backup:run');
    $msg = __('message.scc_msg.create_backup');
    return redirect()->back()->with('scc_msg',$msg);
  }

  public function destroy($file_name)
  {
    $path = storage_path('app/public/backup/'.$file_name);
    File::delete($path);
    $msg = __('message.scc_msg.delete');
    return redirect()->back()->with('scc_msg', $file_name.' '.$msg);
  }
}
