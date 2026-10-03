@extends('layouts.admin')
@section('title')
Album Image Add Form
<div class="card-tools float-end">
    @can('Album Image List')
    <a href="{{ route('admin.album_image.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('page.all')}} {{__('Album Image List')}}</a>
    @endcan
</div>
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
		<form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.album_image.store')}}">
			@csrf

			<div class="row">
                @include('shared.redirect_msg')
				<div class="col-lg-12 new-box after-add-more">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">Image Add Form</h3>

						</div>

						<div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <x-Form::input name="name[]" label="Image {{__('page.title')}}"  placeholder="Ex: আমাদের প্রিয় মাতৃভূমি বাংলাদেশ" autocomplete="off" req="required" />
                                        </div>
                                        <div class="col-md-5">
                                            <x-Form::input type="number" name="order[]" label="{{__('Order/Position')}}"  placeholder="Ex: 2" autocomplete="off"  />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                             <input type="hidden" name="type[]" value="1">
                                            <x-Form::select  name="category_id[]"  id="category_id" class="" label="Album {{__('route.category')}}" :options="$categories" req="required" />
                                        </div>
                                        <div class="col-md-5">
                                            <x-Form::checkbox helper="check is for displaying as Slider Gallery Page" name="is_featured[]"   value="1"  label="Show as Feature Image" />
                                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status[]" default checked class="status" value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    @include('admin.include.image_div_with_value',['label_name'=>'Album Image/Photo','input_name'=>'photo[]'])
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
