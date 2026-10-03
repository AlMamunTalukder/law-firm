<label class="form-label fw-bold">{{$file_title??__('page.pdf')}}</label>
<div class="fileinput fileinput-new input-group" data-provides="fileinput">
    <div class="form-control" data-trigger="fileinput">
        <span class="fileinput-filename">{{$item->file??''}}</span>
    </div>
    <span class="input-group-append">
        <span class="input-group-text fileinput-exists border-danger text-danger" data-dismiss="fileinput">
            Remove
        </span>
        <span class="input-group-text btn-file border-primary text-primary">
            <span class="fileinput-new">Select file</span>
            <span class="fileinput-exists">Change</span>
            <input id="{{$file_id??''}}" type="file" name="{{$file_name??'file'}}" accept="{{$file_accept??'.pdf'}}">
        </span>
    </span>
</div>
@php $fRemove = 'remove_'.($file_name ?? 'file'); $fId = $fRemove.'_'.uniqid(); @endphp
@if(!empty($item->file ?? ''))
<div class="form-check mt-1">
    <input class="form-check-input" type="checkbox" name="{{ $fRemove }}" value="1" id="{{ $fId }}">
    <label class="form-check-label small text-danger" for="{{ $fId }}" style="cursor:pointer;">Remove current file</label>
</div>
@endif
