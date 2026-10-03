@extends('layouts.admin')
@section('title')
Slider List
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('page.all')}} Slider List</h3>
                        <div class="card-tools">
                            @can('Slider Create')
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-square"></i>
                                &nbsp;{{__('page.new')}} {{__('Slider')}}
                            </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @include('shared.redirect_msg')

                        @section('table_head')
                        <th>{{ __('page.sl')}}</th>
                        <th>{{ __('page.title')}}</th>
                        <th>{{ __('page.subtitle')}}</th>
                        <th>{{ __('page.slider')}}</th>
                        <th>{{ __('page.type')}}</th>
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
<x-Form::input name="title" label="{{__('page.title')}}" placeholder="Ex: Title" autocomplete="off" req="required" />
<x-Form::input name="subtitle" label="Subtitle" placeholder="Ex: Subtitle" autocomplete="off" />
@include('admin.include.image_div_modal')
@include('admin.include.slider_type')
<x-Form::checkbox helper="check is active and uncheck is for Inactive" value="1" checked class="status" name="status" label="{{__('page.status')}}" />
@endsection

@include('admin.include.modal_add',['title'=>__('New Slider Add Form'),'id'=>'add_form_custom','route'=>'slider','route_function'=>"get_slider_list()"])

@section('modal_body_edit_component')
<input type="hidden" id="table_id" name="table_id">
<x-Form::input id="edit_modal_name" name="title" label="Title" placeholder="Ex: Title" autocomplete="off" req="required" />
<x-Form::input id="edit_modal_subtitle" name="subtitle" label="Subtitle" placeholder="Ex: Subtitle" autocomplete="off" />
@include('admin.include.image_div_modal',['id'=>'edit_modal_photo'])
@include('admin.include.slider_type',['id'=>'edit_modal_type'])
<x-Form::checkbox id="edit_modal_status" helper="check is active and uncheck is for Inactive" value="1" class="status" name="status" label="{{__('page.status')}}" />
@endsection

@include('admin.include.modal_edit',['title'=>__('Image Edit Form'),'id'=>'edit_form_custom','route'=>'slider','route_function'=>"get_slider_list()"])

@endsection
@push('scripts')
<script type='module'>

    get_slider_list();
</script>
@endpush
