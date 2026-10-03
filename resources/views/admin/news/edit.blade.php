@extends('layouts.admin')
@section('title')
Edit News Form
<div class="card-tools float-end">
    @can('Voting List')
	<a href="{{ route('admin.news.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('page.all')}} {{__('News  List')}}</a>
    @endcan
</div>
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
		<form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.news.store')}}">
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
                            <x-Form::input name="name" value="{{$item->name}}" label="Main {{__('page.title')}}"  placeholder="Ex: বাংলাদেশকে ২০ কোটি ডলারের বেশি সহায়তা দিচ্ছে যুক্তরাষ্ট্র, চুক্তি সই" autocomplete="off" req="required" />

                            <div class="row">
                                <div class="col">
                                    <x-Form::input-group
                                        groupClass="date_picker"
                                        data-input
                                        name="action_date" icon_class="fas fa-calendar"
                                        req="required" label="{{__('Date')}}"
                                        placeholder="{{__('page.dob')}}"
                                        value="{{$item->action_date}}"/>
                                    <x-Form::select placeholder="Choose category" :default="[$selected_cat]" name="category_id" id="category_id" class="select2" label="{{__('Menu')}}" :options="$categories" req="required" />
                                    <x-Form::select  placeholder="Choose subcategory" :default="[$selected_subcat]" :options="$sub_categories" name="subcategory_id" id="subcategory_id" class="select2" label="Sub-{{__('Menu')}}"  />

                                </div>
                                <div class="col">
                                    @include('admin.include.image_div_with_value',['photo'=>$item->photo,'label_name'=>'Photo','resolution_sugg'=>'Recommended size: (1200x630)px; Minimum size: (600x315)px.'])
                                </div>
                            </div>

                            @include('admin.include.quill_editor',['description'=>$item->description])

                            <div class="row mt-2">
								<div class="col">
                                    @if ($item->show_in_home)
									<x-Form::checkbox helper="Show in home page" name="show_in_home" default checked class="show_in_home" value="1"  label="Show in Home" />

                                    @else
                                    <x-Form::checkbox helper="Show in home page" name="show_in_home" class="show_in_home" value="1"  label="Show in Home" />
                                    @endif
								</div>
								<div class="col">
									 <x-Form::input type="number" value="{{$item->order}}"  name="order" label="Order Number"  placeholder="1" autocomplete="off" />
								</div>
							</div>
                            @if ($item->status)
                                <x-Form::checkbox helper="check is active and uncheck is for Inactive" class="status" name="status" checked  value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            @else
                                <x-Form::checkbox helper="check is active and uncheck is for Inactive" class="status" name="status"  value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            @endif

							<x-Form::button type="submit" label="{{__('page.submit')}}"/>
						</div>

					</div>
				</div>

			</div>

		</form>
	</div>

</div>
@endsection
@push('scripts')
    <script type="module">
        $("#checkAll").click(function(){
            $('input.features:checkbox').prop('checked',true);
        });
        $("#unCheckAll").click(function(){
            $('input.features:checkbox').prop('checked',false);
        });
    </script>
@endpush
