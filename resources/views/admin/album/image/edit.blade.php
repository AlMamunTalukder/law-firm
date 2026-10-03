@extends('layouts.admin')
@section('title')
Album Image Edit Form
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
            <input type="hidden" name="table_id" value="{{$item->id}}">
            <input type="hidden" name="type[]" value="1">
			<div class="row">
                @include('shared.redirect_msg')
				<div class="col-lg-12">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">Image Edit Form</h3>
						</div>

						<div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <x-Form::input name="name[]" value="{{$item->name}}" label="Image {{__('page.title')}}"  placeholder="Ex: আমাদের প্রিয় মাতৃভূমি বাংলাদেশ" autocomplete="off" req="required" />
                                        </div>
                                        <div class="col-md-5">
                                            <x-Form::input type="number" value="{{$item->order}}" name="order[]" label="{{__('Order/Position')}}"  placeholder="Ex: 2" autocomplete="off"  />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <x-Form::select  :default="$selected_cat" name="category_id[]" id="category_id" class="select2" label="Album {{__('route.category')}}" :options="$categories" req="required" />
                                        </div>
                                        <div class="col-md-5">

                                            @if ($item->is_featured)
                                                <x-Form::checkbox helper="check is for displaying above on Video Gallery Page" name="is_featured[]"   value="1"  label="Show as Feature Image" checked />
                                            @else
                                                <x-Form::checkbox helper="check is for displaying above on Video Gallery Page" name="is_featured[]"   value="1"  label="Show as Feature Image" />
                                            @endif

                                            @if ($item->status)
                                                <x-Form::checkbox helper="check is active and uncheck is for Inactive" class="status" name="status[]" checked  value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                            @else
                                                <x-Form::checkbox helper="check is active and uncheck is for Inactive" class="status" name="status[]"  value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                     @include('admin.include.image_div_with_value',['label_name'=>'Album Image/Photo','photo'=>$item->photo,'input_name'=>'photo[]'])
                                </div>
                            </div>

                            <x-Form::button type="submit" label="{{__('page.update')}}"/>

						</div>

					</div>
				</div>

			</div>

		</form>
	</div>

</div>
@endsection
