<label class="form-label fw-bold">{{__('page.image')}} </label>
<div class="fileinput fileinput-new d-block text-center" data-provides="fileinput">
    <div class="fileinput-new img-thumbnail m-auto text-center" style="width: 80%; height: 170px;">
        <img style="max-width: 100%;max-height: 100%;" @isset($id)
            id="{{$id}}"
        @endisset  src="{{asset('default.jpg')}}"  alt="">
    </div>
    <div class="fileinput-preview fileinput-exists img-thumbnail m-auto text-center" style="width: 80%; max-height: 170px;"></div>
    <div>
    <span class="btn btn-outline-primary btn-file">
        <span class="fileinput-new">{{__('page.select')}}</span>
        <span class="fileinput-exists">{{__('page.change')}}</span>
        <input onchange="check_file_extension()" type="file" id="profile_image" name="photo">
    </span>
    <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput">{{__('page.delete')}} </a>
    </div>
    <span class="text-danger" id="err_msg"></span>
</div>

@isset($resolution_sugg)
<div class="form-text">ছবির রেজুলেশন ({{$resolution_sugg}})px হলে ভাল দেখাবে</div>
@endisset
