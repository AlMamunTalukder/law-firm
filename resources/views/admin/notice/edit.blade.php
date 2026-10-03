@extends('layouts.admin')
@section('title')
Edit Notice
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.notice.update', $item->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Notice</h3>
                </div>
                <div class="card-body">
                    @include('shared.redirect_msg')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $item->slug) }}">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                @include('admin.include.quill_editor', [
                                    'description' => old('content', $item->content),
                                    'inputId' => 'content',
                                    'inputName' => 'content'
                                ])
                            </div>
                        </div>
                        <div class="col-md-4">
                            @if($item->photo)
                                <div class="mb-2 position-relative d-inline-block">
                                    <img src="{{ asset('storage/'.$item->photo) }}" style="max-width: 100%; border-radius:8px; border:1px solid #e2e8f0;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute" style="top:6px; right:6px; padding:4px 8px; font-size:11px;" onclick="deleteNoticePhoto(this)" data-url="{{ route('admin.media.remove') }}" data-model="Notice" data-id="{{ $item->id }}" data-field="photo"><i class="fas fa-trash me-1"></i> Delete</button>
                                </div>
                            @endif
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control">
                                <small class="text-muted">Choose new file to replace. Use Delete button above to remove current image instantly without saving.</small>
                            </div>
@push('scripts')
<script>
function deleteNoticePhoto(btn){
    if(!confirm('Delete this image?')) return;
    const orig = btn.innerHTML; btn.disabled=true; btn.innerHTML='<i class="fas fa-spinner fa-spin me-1"></i> Deleting...';
    fetch(btn.dataset.url, {method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'}, body: JSON.stringify({model:btn.dataset.model,id:btn.dataset.id,field:btn.dataset.field})})
    .then(r=>r.json()).then(j=>{
        if(j.success){ btn.closest('.mb-2').remove(); btn.disabled=false; location.reload();}
        else { alert(j.message||'Failed'); btn.disabled=false; btn.innerHTML=orig; }
    }).catch(()=>{ alert('Failed'); btn.disabled=false; btn.innerHTML=orig; });
}
</script>
@endpush
                            <div class="form-group">
                                <label>Order</label>
                                <input type="number" name="order" class="form-control" value="{{ old('order', $item->order) }}">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ $item->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$item->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.notice.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
