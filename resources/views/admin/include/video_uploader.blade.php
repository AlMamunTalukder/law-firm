<div  class="upload_video_div" style="{{$style??''}}">
    <label class="form-label fw-bold">{{$label_name??__('Browse Video')}}</label>
    <div class="fileinput fileinput-new input-group" data-provides="fileinput" >
        <div class="form-control" data-trigger="fileinput">
            <span class="fileinput-filename"></span>
        </div>
        <span class="input-group-append">
            <span class="input-group-text fileinput-exists" data-dismiss="fileinput">
            Remove
            </span>
            <span class="input-group-text btn-file">
                <span class="fileinput-new">Select file</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="{{$name??'video'}}" accept="video/*">
            </span>
        </span>
    </div>
</div>
