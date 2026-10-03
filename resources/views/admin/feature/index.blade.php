@extends('layouts.admin')
@section('title')

Feature List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Feature List</h3>
                    <div class="card-tools">
                        @can('Feature Create')
                        <a href="{{ route('admin.feature.create') }}"  class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.add')}} {{__('page.new')}} Feature</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                    <th>{{ __('page.sl')}}</th>
                      <th>{{ __('page.image')}}</th>
                      <th>{{ __('page.name')}}</th>
                      <th>{{ __('Link')}}</th>
                      <th>{{ __('Order')}}</th>
                      <th>{{ __('page.status')}}</th>
                      <th>{{ __('page.action')}}</th>
                    @endsection
                    @include('admin.include.table',['table_body_class'=>'sortable_table_contents'])

                </div>

            </div>
            </div>

        </div>

    </div>

</div>

@endsection
@push('scripts')

    <script type='module'>
        get_feature_list();
    </script>
@endpush
