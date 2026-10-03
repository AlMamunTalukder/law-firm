<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonateSetting;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonateController extends Controller
{
    public function index()
    {
        $item = DonateSetting::first();
        $banks = BankAccount::orderBy('order')->orderBy('id')->get();
        return view('admin.donate.index', compact('item','banks'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string|max:255',
            'description'=>'nullable|string',
            'hero_title'=>'nullable|string|max:255',
            'hero_subtitle'=>'nullable|string|max:500',
            'qr_image'=>'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'hero_image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'bank_name.*'=>'nullable|string|max:255',
            'account_name.*'=>'nullable|string|max:255',
            'account_no.*'=>'nullable|string|max:255',
            'branch.*'=>'nullable|string|max:255',
            'routing_no.*'=>'nullable|string|max:255',
        ]);
        $item = DonateSetting::first();
        if(!$item) $item = DonateSetting::create(['title'=>'Donate Us']);

        $data = $request->only(['title','description','hero_title','hero_subtitle']);
        if($request->has('remove_qr_image') && $item->qr_image){
            if(Storage::disk('public')->exists($item->qr_image)) Storage::disk('public')->delete($item->qr_image);
            $data['qr_image'] = null;
        }
        if($request->hasFile('qr_image')){
            if($item->qr_image && Storage::disk('public')->exists($item->qr_image)) Storage::disk('public')->delete($item->qr_image);
            $data['qr_image'] = upload_file('donate_qr', $request->file('qr_image'), 'donate');
        }
        if($request->has('remove_hero_image') && $item->hero_image){
            if(Storage::disk('public')->exists($item->hero_image)) Storage::disk('public')->delete($item->hero_image);
            $data['hero_image'] = null;
        }
        if($request->hasFile('hero_image')){
            if($item->hero_image && Storage::disk('public')->exists($item->hero_image)) Storage::disk('public')->delete($item->hero_image);
            $data['hero_image'] = upload_file('donate_hero', $request->file('hero_image'), 'donate');
        }
        $item->update($data);

        // sync bank accounts - delete removed ones, update/create
        $ids = $request->input('bank_id', []);
        $names = $request->input('bank_name', []);
        $anames = $request->input('account_name', []);
        $nos = $request->input('account_no', []);
        $branches = $request->input('branch', []);
        $routings = $request->input('routing_no', []);
        $orders = $request->input('bank_order', []);

        $keepIds = [];
        foreach($names as $i => $bn){
            $bn = trim((string)$bn);
            $an = trim((string)($nos[$i] ?? ''));
            if($bn === '' && $an === '') continue;
            $payload = [
                'bank_name' => $bn ?: 'Bank',
                'account_name' => $anames[$i] ?? null,
                'account_no' => $nos[$i] ?? null,
                'branch' => $branches[$i] ?? null,
                'routing_no' => $routings[$i] ?? null,
                'order' => (int)($orders[$i] ?? $i),
            ];
            $bid = $ids[$i] ?? null;
            if($bid && ($bank = BankAccount::find($bid))){
                $bank->update($payload);
                $keepIds[] = $bank->id;
            } else {
                $bank = BankAccount::create($payload);
                $keepIds[] = $bank->id;
            }
        }
        // delete banks not in keepIds (if user removed rows)
        if(!empty($keepIds)){
            BankAccount::whereNotIn('id', $keepIds)->delete();
        } else {
            // if all empty, keep existing
        }

        return redirect()->route('admin.donate.index')->with('scc_msg','Donate page updated');
    }

    public function destroyBank($id)
    {
        $bank = BankAccount::findOrFail($id);
        $bank->delete();
        return response()->json(['success'=>true,'message'=>'Bank removed']);
    }
}
