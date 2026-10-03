@extends('layouts.admin')
@section('title')
Album Category List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Album Category List</h3>
                    <div class="card-tools">
                        @can('Album Category Create')
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} Album {{__('Category')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th>{{ __('page.page_name_url')}}</th>
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

        <x-Form::input name="name" label="{{__('route.category')}} {{__('page.name')}}"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
        @include('admin.include.album_category')

        <x-Form::input req="required" small="(Please enter the url name in english)" type="text" name="slug" label="{{__('page.page_name_url')}}" placeholder="Ex: traveling (Must be in english)"  autocomplete="off" />

        <x-Form::checkbox name="status" checked helper="check is active and uncheck is for Inactive"  class="status"  value="1"  label="{{__('page.status')}}" />
    @endsection
    @include('admin.include.modal_add',['title'=>__('New Album Image-Video Category Form'),'id'=>'add_form','route'=>'album_category'])

    @section('modal_body_edit_component')
        <input type="hidden" id="table_id" name="table_id">
        <x-Form::input id="edit_modal_name" name="name" label="{{__('route.category')}} {{__('page.name')}}"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
        @include('admin.include.album_category',['id'=>'edit_modal_album_type'])
        <x-Form::input  req="required" small="(Please enter the url name in english)" type="text" id="edit_modal_short_name" name="slug" label="{{__('page.page_name_url')}}" placeholder="Ex: traveling (Must be in english)"  autocomplete="off" />

        <x-Form::checkbox id="edit_modal_status" helper="check is active and uncheck is for Inactive"  class="status" name="status"  value="1"  label="{{__('page.status')}}" />
    @endsection
    @include('admin.include.modal_edit',['title'=>__('Album Image-Video Category Edit Form'),'id'=>'edit_form','route'=>'album_category'])

@endsection
@push('scripts')
    <script type='module'>
        get_common_list('album_category');
    </script>
@endpush
