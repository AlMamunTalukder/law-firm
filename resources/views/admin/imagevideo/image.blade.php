@extends('layouts.admin')
@section('title')
Image List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Image List</h3>
                    <div class="card-tools">
                        @can('Image Create')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Image')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th>{{ __('page.image')}}</th>
                      <th>{{ __('route.category')}}</th>
                      <th>{{ __('page.title')}}</th>
                      <th>{{ __('page.features')}}</th>
                      <th>{{ __('page.status')}}</th>
                      <th>{{ __('page.action')}}</th>
                    @endsection
                    @include('admin.include.table')

                </div>

            </div>
            </div>

        </div>

    </div>

</div>

    @section('modal_body_add_component')

        <x-Form::input name="name" label="{{__('page.title')}}"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
        <x-Form::select class="select2" name="category_id" label="{{__('route.category')}} {{__('page.name')}}" :options="$categories"  autocomplete="off" />
        <input type="hidden" name="type" value="1">
        @include('admin.include.image_div_modal')

        <x-Form::checkbox name="important" helper="Want to show this item in 'Slider' at image page "  value="1"  label="{{__('Slider Image')}}" />

        <x-Form::checkbox name="status" checked helper="check is active and uncheck is for Inactive"  class="status"  value="1"  label="{{__('page.status')}}" />
    @endsection
    @include('admin.include.modal_add',['title'=>__('New Image Add Form'),'id'=>'add_form_custom','route'=>'image','route_function'=>"get_image_video_list('image')"])

    @section('modal_body_edit_component')
        <input type="hidden" id="table_id" name="table_id">
        <x-Form::input id="edit_modal_name" name="name" label="{{__('route.category')}} {{__('page.name')}}"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
        <input type="hidden" name="type" value="1">

        <x-Form::select id="edit_modal_short_name" class="select2"  name="category_id" label="{{__('route.category')}} {{__('page.name')}}" :options="$categories"  autocomplete="off" />
        @include('admin.include.image_div_modal',['id'=>'edit_modal_photo'])
        <x-Form::checkbox id="edit_modal_important" name="important" helper="Want to show this item in 'Slider' at image page"  value="1"  label="{{__('Slider Image')}}" />

        <x-Form::checkbox id="edit_modal_status" helper="check is active and uncheck is for Inactive"  class="status" name="status"  value="1"  label="{{__('page.status')}}" />
    @endsection
    @include('admin.include.modal_edit',['title'=>__('Image Edit Form'),'id'=>'edit_form_custom','route'=>'image','route_function'=>"get_image_video_list('image')"])

@endsection
@push('scripts')
    <script type='module'>
        get_image_video_list('image');
    </script>
@endpush
