@extends('layouts.admin')
@section('title')
Album Video Add Form
<div class="card-tools float-end">
	@can('Album Video List')
	<a href="{{ route('admin.album_video.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('page.all')}} {{__('Album Video List')}}</a>
	@endcan
</div>
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
		<form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.album_video.store')}}">
			@csrf
			<div class="row">
				@include('shared.redirect_msg')
				<div class="col-lg-12 new-box after-add-more">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">Video Add Form</h3>

						</div>

						<div class="card-body">
                            <div class="row">
                                <input type="hidden" name="type[]" value="2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <x-Form::input name="name[]" label="Video {{__('page.title')}}"  placeholder="Ex: আমাদের প্রিয় মাতৃভূমি বাংলাদেশ" autocomplete="off" req="required" />

                                        <x-Form::select  name="category_id[]"  id="category_id"  label="Album {{__('route.category')}}" :options="$categories" required />

                                        <div class="video_link">
                                            <x-Form::textarea rows="2" placeholder="Place embaded link for youtube videos" label="Video Link" name="link[]"/>
                                        </div>

                                        <x-Form::input type="number" name="order[]" label="{{__('Order/Position')}}"  placeholder="Ex: 2" autocomplete="off" />

                                    </div>
                                    <div class="col-md-4">
                                        @include('admin.include.video_type',['name'=>'video_type[]'])

                                        <x-Form::checkbox helper="check is for displaying in home slider" name="is_show_in_home[]"   value="1"  label="Show in Home Slider" />
                                        <x-Form::checkbox helper="check is for displaying above on image slider" name="is_home_slider_sticky[]"   value="1"  label="Show in Home Above Image Slider" />
                                        <x-Form::checkbox helper="check is for displaying above on Video Gallery Page" name="is_featured[]"   value="1"  label="Show as Feature Video" />
                                        <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status[]" default checked class="status" value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                    </div>

                                    <div class="col-md-3">
                                        @include('admin.include.video_uploader',['style'=>'display:none','name'=>'video[]'])
                                        @include('admin.include.image_div_with_value',['label_name'=>'Thumbnail Image','input_name'=>'photo'])
                                    </div>
                                </div>

                            </div>

						</div>

					</div>
				</div>
                <div class="before-add-more"></div>
				<div class="mt-4 mb-4 text-center">
					<x-Form::button type="submit" label="{{__('page.submit')}}"/>
				</div>

			</div>

		</form>
	</div>

</div>
@endsection
@push('scripts')
<script type="module">
    $("body").on("change", '.video_type', function (e){
        if (this.value==3) {
            $(this).closest('.card-body').find('.upload_video_div').fadeIn();
            $(this).closest('.card-body').find('.video_link').hide();
        }
        else
        {
            $(this).closest('.card-body').find('.upload_video_div').hide();
            $(this).closest('.card-body').find('.video_link').fadeIn();
        }
    });
</script>
@endpush
