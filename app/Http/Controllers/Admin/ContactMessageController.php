<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request){
        $items = ContactMessage::orderByDesc('id')->paginate(15);
        return view('admin.contact.index', compact('items'));
    }
    public function show($id){
        $item = ContactMessage::findOrFail($id);
        $item->update(['is_read'=>true]);
        return view('admin.contact.show', compact('item'));
    }
    public function destroy($id){
        $item = ContactMessage::findOrFail($id);
        $item->delete();
        return response()->json(['success'=>true,'message'=>'Deleted']);
    }
}
