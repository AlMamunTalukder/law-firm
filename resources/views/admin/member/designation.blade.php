@extends('layouts.admin')
@section('title')
{{ __('route.designation_list')}}
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} {{ __('route.designation_list')}}</h3>
                    <div class="card-tools">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Designation ')}}</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th>{{ __('Type')}}</th>
                      <th>{{ __('page.status')}}</th>
                      <th width="300px">{{ __('page.action')}}</th>
                    @endsection
                    @include('admin.include.table')

                </div>

            </div>
            </div>

        </div>

    </div>

</div>

    @section('modal_body_add_component')

        <x-Form::input name="name" label="{{__('page.name')}}"  placeholder="Ex: Chairman" autocomplete="off" req="required" />
         @include('admin.include.designation_type')
        <x-Form::checkbox name="status" checked labelClass="mt-1 ms-2" class="status" value="1"  label="{{__('page.status')}}"  />
    @endsection
    @include('admin.include.modal_add',['title'=>__('page.designation'),'id'=>'add_form','route'=>'designation'])

    @section('modal_body_edit_component')
        <input type="hidden" id="table_id" name="table_id">
        <x-Form::input id="edit_modal_name" name="name" label="{{__('page.name')}}"  placeholder="Ex: Chairman" autocomplete="off" req="required" />
         @include('admin.include.designation_type', ['id' => 'edit_modal_designation_type'])
        <x-Form::checkbox id="edit_modal_status" name="status" class="status" label="{{__('page.active')}}/{{__('page.inactive')}}" labelClass="mt-1 ms-2" />
    @endsection
    @include('admin.include.modal_edit',['title'=>__('page.designation'),'id'=>'edit_form','route'=>'designation'])

@endsection
@push('scripts')
    <script type='module'>
        get_common_list('designation');
    </script>
@endpush
