<label class="form-label fw-bold">{{$label_name??__('page.image')}}</label>
<div class="fileinput fileinput-new d-block text-center" data-provides="fileinput">
    <div class="fileinput-new img-thumbnail m-auto text-center" style="width: 80%; height: 170px;">
        @if(isset($photo))
        <img style="max-width: 100%;max-height: 100%" src="{{asset('storage/'.$photo)}}"  alt="">
        @else
            <img style="max-width: 100%;max-height: 100%" src="{{asset('default.jpg')}}"  alt="">
        @endif
    </div>
    <div class="fileinput-preview fileinput-exists img-thumbnail m-auto text-center" style="width: 80%; max-height: 170px;"></div>
    <div>
     <span class="btn btn-outline-primary btn-file">
        <span class="fileinput-new">{{__('page.select')}}</span>
        <span class="fileinput-exists">{{__('page.change')}}</span>
        <input accept="image/*" type="file"  name="{{$input_name??'photo'}}">
    </span>
    <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput">{{__('page.delete')}} </a>
    </div>
    <span class="text-danger" id="err_msg"></span>
</div>
@php $removeField = 'remove_'.($input_name ?? 'photo'); $removeId = $removeField.'_'.uniqid(); $hasDirectDelete = isset($model) && isset($model_id) && isset($photo) && $photo; @endphp
@if(isset($photo) && $photo)
    @if($hasDirectDelete)
        <div class="mt-2 text-center" style="width:80%; margin:0 auto;">
            <button type="button" class="btn btn-sm btn-danger btn-remove-media" data-model="{{ $model }}" data-id="{{ $model_id }}" data-field="{{ $input_name ?? 'photo' }}" data-url="{{ route('admin.media.remove') }}"><i class="fas fa-trash me-1"></i> Delete Image</button>
            <div class="remove-feedback small mt-1" style="display:none;"></div>
        </div>
    @else
        <div class="form-check mt-2 text-start" style="width:80%; margin:0 auto;">
            <input class="form-check-input" type="checkbox" name="{{ $removeField }}" value="1" id="{{ $removeId }}">
            <label class="form-check-label small text-danger" for="{{ $removeId }}" style="cursor:pointer;">Remove current image (save to apply)</label>
        </div>
    @endif
@endif
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.btn-remove-media').forEach(btn=>{
        btn.addEventListener('click', function(){
            if(!confirm('Delete this image? This cannot be undone.')) return;
            const orig = btn.innerHTML; btn.disabled=true; btn.innerHTML='<i class="fas fa-spinner fa-spin me-1"></i> Deleting...';
            fetch(btn.dataset.url, {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}', 'Accept':'application/json'},
                body: JSON.stringify({model: btn.dataset.model, id: btn.dataset.id, field: btn.dataset.field})
            }).then(r=>r.json()).then(j=>{
                const fb = btn.parentElement.querySelector('.remove-feedback');
                if(j.success){
                    if(fb){ fb.style.display='block'; fb.className='remove-feedback small mt-1 text-success'; fb.textContent='Deleted! Reloading...';}
                    btn.closest('.fileinput').querySelector('img').src='{{ asset('default.jpg') }}';
                    setTimeout(()=> location.reload(), 800);
                } else {
                    if(fb){ fb.style.display='block'; fb.className='remove-feedback small mt-1 text-danger'; fb.textContent=j.message||'Failed';}
                    btn.disabled=false; btn.innerHTML=orig;
                }
            }).catch(()=>{ btn.disabled=false; btn.innerHTML=orig; alert('Failed');});
        });
    });
});
</script>
@endpush
@isset($resolution_sugg)
<div class="form-text">{{$resolution_sugg}}</div>
@endisset
