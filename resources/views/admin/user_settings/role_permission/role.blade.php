@extends('layouts.admin')
@section('title')
Role List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Role List</h3>
                    <div class="card-tools">

                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('route.role')}}</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th width="200px">{{ __('Created at')}}</th>
                      <th>{{ __('page.status')}}</th>
                      <th width="400px">{{ __('page.action')}}</th>
                    @endsection
                    @include('admin.include.table')

                </div>

            </div>
            </div>

        </div>

    </div>

</div>

    @section('modal_body_add_component')

        <x-Form::input name="name" label="{{__('route.role')}} {{__('page.name')}}"  placeholder="Ex: Admin" autocomplete="off" req="required" />
        <x-Form::checkbox helper="check is active and uncheck is for Inactive"  class="status" checked name="status"  value="1"  label="{{__('page.status')}}" />
    @endsection
    @include('admin.include.modal_add',['title'=>__('Role Add Form'),'id'=>'add_form','route'=>'role'])

    @section('modal_body_edit_component')
        <input type="hidden" id="table_id" name="table_id">
        <x-Form::input id="edit_modal_name" name="name" label="{{__('route.role')}} {{__('page.name')}}"  placeholder="Ex: Admin"  autocomplete="off" req="required" />
        <x-Form::checkbox id="edit_modal_status" helper="check is active and uncheck is for Inactive"  class="status" name="status"  value="1"  label="{{__('page.status')}}" />
    @endsection
    @include('admin.include.modal_edit',['title'=>__('Role Edit Form'),'id'=>'edit_form','route'=>'role'])

@endsection
@push('scripts')
    <script type='module'>

        get_common_list('role');
    </script>
@endpush
