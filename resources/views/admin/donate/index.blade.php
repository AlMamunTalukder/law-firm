@extends('layouts.admin')
@section('title') Donate Us Settings @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        @include('shared.redirect_msg')
        <form method="POST" action="{{ route('admin.donate.update') }}" enctype="multipart/form-data" class="validate_form">@csrf
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Hero — Portrait Image + Big Text on Top</h3></div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-lg-5">
                            @include('admin.include.image_div_with_value',['label_name'=>'Hero Image','input_name'=>'hero_image','photo'=>$item->hero_image ?? null,'resolution_sugg'=>'Any ratio — Landscape 1920×1080 or Portrait 1080×1350. Auto fit, dark overlay, JPG/WebP max 8MB.'])
                            @if(!empty($item->hero_image))<div class="form-check mt-2"><input type="checkbox" name="remove_hero_image" value="1" class="form-check-input" id="rh"><label for="rh" class="form-check-label small text-danger">Remove hero image on save (fallback to gradient)</label></div>@endif
                        </div>
                        <div class="col-lg-7">
                            <x-Form::input name="hero_title" value="{{ $item->hero_title ?? $item->title ?? '' }}" label="Big Title on Image" placeholder="e.g. Stand With Us — Your Help Matters" />
                            <div class="small text-muted mb-3">Shown in <b>huge white type</b> centered on the portrait. Keep it short (2–6 words) for impact. Leave empty to use the Title below.</div>
                            <x-Form::input name="hero_subtitle" value="{{ $item->hero_subtitle ?? '' }}" label="Subtitle on Image (optional)" placeholder="e.g. Every donation builds a child's future" />
                            <div class="small text-muted">Smaller white text under the big title. Optional.</div>
                            <hr>
                            <div class="small text-muted">Tip: Use the <b>Description editor below</b> for the long rich text that appears <em>under</em> the hero. The hero text above is only for the image overlay.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Donate Page — Text & QR</h3></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <x-Form::input name="title" value="{{ $item->title ?? 'Donate Us' }}" label="Title (fallback / SEO)" />
                            <label class="fw-bold">Description (supports all editor features)</label>
                            @include('admin.include.quill_editor',['description'=>$item->description ?? '','inputId'=>'description','inputName'=>'description'])
                        </div>
                        <div class="col-lg-4">
                            @include('admin.include.image_div_with_value',['label_name'=>'QR Code Image','input_name'=>'qr_image','photo'=>$item->qr_image ?? null])
                            <div class="small text-muted mt-2">Shown on Donate page. PNG/WebP, square recommended.</div>
                            @if(!empty($item->qr_image))<div class="form-check mt-2"><input type="checkbox" name="remove_qr_image" value="1" class="form-check-input" id="rq"><label for="rq" class="form-check-label small text-danger">Remove QR on save</label></div>@endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-success card-outline">
                <div class="card-header d-flex justify-content-between align-items-center"><h3 class="card-title">Bank Accounts</h3><button type="button" id="addBank" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i> Add Bank</button></div>
                <div class="card-body">
                    <p class="small text-muted">Cards on Donate page. Leave empty rows will be skipped.</p>
                    <div id="bankRows">
                        @forelse($banks as $b)
                        <div class="bank-row border rounded p-3 mb-3 bg-light">
                            <input type="hidden" name="bank_id[]" value="{{ $b->id }}">
                            <div class="row g-2">
                                <div class="col-md-3"><label class="fw-bold small">Bank Name</label><input name="bank_name[]" value="{{ $b->bank_name }}" class="form-control form-control-sm" placeholder="Islami Bank"></div>
                                <div class="col-md-3"><label class="fw-bold small">Account Name</label><input name="account_name[]" value="{{ $b->account_name }}" class="form-control form-control-sm" placeholder="Law Firm"></div>
                                <div class="col-md-2"><label class="fw-bold small">Account No</label><input name="account_no[]" value="{{ $b->account_no }}" class="form-control form-control-sm" placeholder="123..."></div>
                                <div class="col-md-2"><label class="fw-bold small">Branch</label><input name="branch[]" value="{{ $b->branch }}" class="form-control form-control-sm"></div>
                                <div class="col-md-2"><label class="fw-bold small">Routing</label><input name="routing_no[]" value="{{ $b->routing_no }}" class="form-control form-control-sm"><input type="hidden" name="bank_order[]" value="{{ $b->order }}"></div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm w-100 mt-2 remove-bank"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                        @empty
                        <div class="bank-row border rounded p-3 mb-3 bg-light">
                            <input type="hidden" name="bank_id[]" value="">
                            <div class="row g-2">
                                <div class="col-md-3"><label class="fw-bold small">Bank Name</label><input name="bank_name[]" class="form-control form-control-sm" placeholder="Islami Bank"></div>
                                <div class="col-md-3"><label class="fw-bold small">Account Name</label><input name="account_name[]" class="form-control form-control-sm" placeholder="Law Firm"></div>
                                <div class="col-md-2"><label class="fw-bold small">Account No</label><input name="account_no[]" class="form-control form-control-sm" placeholder="123..."></div>
                                <div class="col-md-2"><label class="fw-bold small">Branch</label><input name="branch[]" class="form-control form-control-sm"></div>
                                <div class="col-md-2"><label class="fw-bold small">Routing</label><input name="routing_no[]" class="form-control form-control-sm"><input type="hidden" name="bank_order[]" value="0"></div>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm w-100 mt-2 remove-bank"><i class="fas fa-trash"></i> Remove</button>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="text-center mb-4"><button class="btn btn-primary btn-lg px-5">Save Donate Page</button></div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script type="module">
document.getElementById('addBank')?.addEventListener('click',()=>{
    const r=document.createElement('div'); r.className='bank-row border rounded p-3 mb-3 bg-light';
    r.innerHTML=`<input type="hidden" name="bank_id[]" value=""><div class="row g-2"><div class="col-md-3"><label class="fw-bold small">Bank Name</label><input name="bank_name[]" class="form-control form-control-sm" placeholder="Islami Bank"></div><div class="col-md-3"><label class="fw-bold small">Account Name</label><input name="account_name[]" class="form-control form-control-sm" placeholder="Law Firm"></div><div class="col-md-2"><label class="fw-bold small">Account No</label><input name="account_no[]" class="form-control form-control-sm" placeholder="123..."></div><div class="col-md-2"><label class="fw-bold small">Branch</label><input name="branch[]" class="form-control form-control-sm"></div><div class="col-md-2"><label class="fw-bold small">Routing</label><input name="routing_no[]" class="form-control form-control-sm"><input type="hidden" name="bank_order[]" value="0"></div></div><button type="button" class="btn btn-danger btn-sm w-100 mt-2 remove-bank"><i class="fas fa-trash"></i> Remove</button>`;
    document.getElementById('bankRows').appendChild(r);
});
document.addEventListener('click',e=>{
    if(e.target.closest('.remove-bank')){
        const rows=document.querySelectorAll('#bankRows .bank-row');
        if(rows.length>1) e.target.closest('.bank-row').remove(); else alert('At least one row');
    }
});
</script>
@endpush
