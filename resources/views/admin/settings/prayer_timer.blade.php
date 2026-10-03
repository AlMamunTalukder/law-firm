@extends('layouts.admin')
@section('title')
Prayer Timer List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Prayer Timer List</h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th>{{ __('Time')}}</th>
                      <th>{{ __('page.type')}}</th>
                      <th width="300px">{{ __('page.action')}}</th>
                    @endsection
                    @include('admin.include.table',['table_body_class'=>'sortable_table_contents'])

                </div>

            </div>
            </div>

        </div>

    </div>

</div>

    @section('modal_body_add_component')

        <x-Form::input name="name" label="Prayer TImer {{__('page.name')}}"  placeholder="Ex: Facebook" autocomplete="off" req="required" />
        <x-Form::input name="icon" label="Icon Class"  placeholder="Ex: bx bxl-facebook" autocomplete="off" req="required" />

        <x-Form::input type="number" name="salary" label="{{__('page.salary')}}"  placeholder="Ex: 15000" autocomplete="off" req="required" />
    @endsection
    @include('admin.include.modal_add',['title'=>__('page.add_new_member'),'id'=>'add_form','route'=>'socialmedia'])

    @section('modal_body_edit_component')
        <input type="hidden" id="table_id" name="table_id">
        <x-Form::input id="edit_modal_name" name="name" label="Prayer Name {{__('page.name')}}"  placeholder="Ex: মুহাম্মদ আব্দুল্লাহ" readonly autocomplete="off" req="required" />

        <x-Form::input-group
            groupClass="time_picker time_picker_edit"
            id="time_picker_edit"
            data-input
            name="timing" icon_class="fas fa-clock"
            req="required" label="{{__('Prayer Time')}}"
            />

    @endsection
    @include('admin.include.modal_edit',['title'=>__('Prayer Timer Edit Form'),'id'=>'edit_form','route'=>'prayertimer'])

@endsection
@push('scripts')
    <script type='module'>
        setTimeout(() => {
            $( ".sortable_table_contents" ).sortable({
                items: "tr",
                cursor: 'grabbing',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer('PrayerTimer');
                    get_common_list('prayertimer');
                }
            });
        }, 100);
        get_common_list('prayertimer');
    </script>
@endpush
