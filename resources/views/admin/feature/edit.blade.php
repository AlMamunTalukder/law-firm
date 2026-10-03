@extends('layouts.admin')
@section('title')

Feature Edit Form
<div class="card-tools float-end">
    @can('Feature List')
	<a href="{{ route('admin.feature.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('page.all')}} Feature List</a>
    @endcan
</div>
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
		<form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.feature.store')}}">
			@csrf

			<div class="row">
                @include('shared.redirect_msg')
				<div class="col-lg-8">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h3 class="card-title">Basic Info</h3>
						</div>

						<div class="card-body">

                            <input type="hidden" name="table_id" value="{{$item->id}}">
                            <div class="row">
                                <div class="col">
                                    <x-Form::input value="{{$item->name}}" name="name" label="Main {{__('page.title')}}"  placeholder="Ex: Title of Feature" autocomplete="off" req="required" />
                                    <x-Form::input value="{{$item->link}}" name="link" label="{{__('Link')}}"  placeholder="Ex: Link" autocomplete="off" req="required" />
                                    <x-Form::input value="{{$item->order}}" type="number" name="order" label="{{__('Order/Position')}}"  placeholder="Ex: 2" autocomplete="off"  req="required"/>
                                </div>
                                <div class="col">
                                    @include('admin.include.image_div_with_value',['photo'=>$item->photo,'label_name'=>'Feature Photo','resolution_sugg'=>'Recommended size: (100x100)px;'])
                                </div>
                            </div>
                            @if ($item->status)
                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status" default checked class="status" value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            @else
                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status" class="status" value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            @endif
							<x-Form::button type="submit" label="{{__('page.update')}}"/>
							<x-Form::button type="submit" label="{{__('page.submit')}}"/>
						</div>

					</div>
				</div>

			</div>

		</form>
	</div>

</div>
@endsection
