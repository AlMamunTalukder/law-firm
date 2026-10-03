@extends('layouts.admin')
@section('title')
{{ __('page.district')}} {{ __('route.list')}}
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} {{ __('page.district')}} {{ __('route.list')}}</h3>
                    <div class="card-tools">
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('page.district')}}</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>

                      <th>{{ __('page.name')}}</th>
                      <th>{{ __('page.code')}}</th>
                      <th>{{ __('page.division')}} {{ __('page.name')}}</th>
                      <th width="200px">{{ __('page.action')}}</th>
                    @endsection
                    @include('admin.include.table',['table_body_class'=>'sortable_table_contents'])

                </div>

            </div>
            </div>

        </div>

    </div>

</div>

    @section('modal_body_add_component')
        @include('admin.include.division_select')
        <x-Form::input name="name" label="{{__('page.name')}}"  autocomplete="off" req="required" />
        <x-Form::input type="number" helperClass="text-danger" helper="Type in English" name="code" label="{{__('page.code')}}"  autocomplete="off"/>
    @endsection
    @include('admin.include.modal_add',['title'=>__('page.district').' '.__('page.form'),'id'=>'add_form','route'=>'district'])

    @section('modal_body_edit_component')
        <input type="hidden" id="table_id" name="table_id">
        @include('admin.include.division_select',['id'=>'edit_modal_division_id'])
        <x-Form::input id="edit_modal_name" name="name" label="{{__('page.name')}}"  placeholder="{{__('page.title')}}" autocomplete="off" req="required" />
        <x-Form::input type="number" helperClass="text-danger" helper="Type in English" id="edit_modal_short_name" name="code" label="{{__('page.code')}}"  placeholder="{{__('page.link')}}" autocomplete="off"  />

    @endsection
    @include('admin.include.modal_edit',['title'=>__('page.district').' '.__('page.edit').' '.__('page.form'),'id'=>'edit_form','route'=>'district'])

@endsection
@push('scripts')
    <script type='module'>
        get_common_list('district');
    </script>
@endpush
