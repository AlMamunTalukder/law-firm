@extends('layouts.admin')
@section('title')
{{ __('Writer List')}}
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} {{ __('Writer List')}}</h3>
                    <div class="card-tools">
                        @can('Writer Create')
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Writer')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="120px">{{ __('page.image')}}</th>
                      <th>{{ __('page.description')}}</th>
                      <th>{{ __('page.designation')}}</th>
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
        <div class="row">
            <div class="col">
                <x-Form::input name="name" label="{{__('page.name')}}"  placeholder="Ex: Mr. John" autocomplete="off" req="required" />
                <x-Form::input type="email" name="email" label="{{__('page.email')}}"  placeholder="Ex: abc@example.com" autocomplete="off"  />
                <x-Form::input type="number" name="phone_no" label="{{__('page.phone')}}"  placeholder="01XXXXXXXXX" autocomplete="off"  />

            </div>
            <div class="col">

                <x-Form::select id="modal_designations" multiple data-placeholder="{{__('page.choose_option')}}" label="{{__('page.designation')}}" class="select2" name="designation_ids[]" req="required" :options="$designations" />
                @include('admin.include.image_div_with_value')
            </div>
        </div>

    @endsection
    @include('admin.include.modal_add',['modal_class'=>'modal-lg','title'=>__('Add New Writer Form'),'id'=>'add_form','route'=>'writer'])

    @section('modal_body_edit_component')
        <div class="row">
            <div class="col">
                <input type="hidden" id="table_id" name="table_id">
                <x-Form::input id="edit_modal_name" name="name" label="{{__('page.name')}}"  placeholder="Ex: Mr John" autocomplete="off" req="required" />
                <x-Form::input type="email" id="edit_modal_short_name" name="email" label="{{__('page.email')}}"  placeholder="Ex: abc@example.com" autocomplete="off"  />
                <x-Form::input type="number" id="edit_modal_phone_no" name="phone_no" label="{{__('page.phone')}}"  placeholder="01XXXXXXXXX" autocomplete="off"  />

            </div>
            <div class="col">
                <x-Form::select id="edit_modal_designations" multiple data-placeholder="{{__('page.choose_option')}}" label="{{__('page.designation')}}" class="select2" name="designation_ids[]" req="required" :options="$designations" />
                @include('admin.include.image_div_modal',['id'=>'edit_modal_photo'])
            </div>
        </div>

    @endsection
    @include('admin.include.modal_edit',['modal_class'=>'modal-lg','title'=>__('Writer Edit Form'),'id'=>'edit_form','route'=>'writer'])

@endsection
@push('scripts')
    <script type='module'>
        get_common_list('writer');
    </script>
@endpush
