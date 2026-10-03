@extends('layouts.admin')
@section('title')
Video List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Video List</h3>
                    <div class="card-tools">
                        @can('Video Create')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Video')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th>{{ __('Video')}}</th>
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

        <div class="row">
            <div class="col border-end">
                <x-Form::input name="name" label="{{__('page.title')}}"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
                <x-Form::select class="select2" name="category_id" label="{{__('route.category')}} {{__('page.name')}}" :options="$categories"  autocomplete="off" />
                <input type="hidden" name="type" value="2">
                <x-Form::input helperClass="text-danger" helper="add text after 'https://www.youtube.com/watch?v=' this from the url" name="link" label="{{__('Youtube Video Link')}}"  placeholder="Ex: ImB907Dm4NQ" autocomplete="off" req="required" />
                <x-Form::checkbox name="status" checked helper="check is active and uncheck is for Inactive"  class="status"  value="1"  label="{{__('page.status')}}" />
            </div>
            <div class="col">
                <h4>Check to add this video in particular sections </h4>
                <x-Form::checkbox name="important" helper="Want to set this item in 'Category Top Video' at video page" label="{{__('Category Top Video')}}" />

            </div>
        </div>

    @endsection
    @include('admin.include.modal_add',['modal_class'=>'modal-lg','title'=>__('New Video Add Form'),'id'=>'add_form_custom','route'=>'video','route_function'=>"get_image_video_list('video')"])

    @section('modal_body_edit_component')
        <div class="row">
            <div class="col border-end">
                <input type="hidden" id="table_id" name="table_id">
                <x-Form::input id="edit_modal_name" name="name" label="{{__('route.category')}} {{__('page.name')}}"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
                <input type="hidden" name="type" value="2">
                <x-Form::select id="edit_modal_short_name" class="select2"  name="category_id" label="{{__('route.category')}} {{__('page.name')}}" :options="$categories"  autocomplete="off" />
                <x-Form::input id="edit_modal_phone_no" helperClass="text-danger" helper="add text after 'https://www.youtube.com/watch?v=' this from the url" name="link" label="{{__('Youtube Video Link')}}"  placeholder="Ex: ImB907Dm4NQ" autocomplete="off" req="required" />
                <x-Form::checkbox id="edit_modal_status" helper="check is active and uncheck is for Inactive"  class="status" name="status"  value="1"  label="{{__('page.status')}}" />
            </div>
            <div class="col">
                <h4>Check to add this video in particular sections </h4>
                <x-Form::checkbox id="edit_modal_important" name="important" helper="Want to set this item in 'Top Video' at video page"  value="1"  label="{{__('Top Video')}}" />

            </div>
        </div>
    @endsection
    @include('admin.include.modal_edit',['modal_class'=>'modal-lg','title'=>__('Video Edit Form'),'id'=>'edit_form_custom','route'=>'video','route_function'=>"get_image_video_list('video')"])

@endsection
@push('scripts')
    <script type='module'>
        get_image_video_list('video');
    </script>
@endpush
