@extends('layouts.admin')
@section('title')
Advertise List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Advertise List </h3>
                    <div class="card-tools">
                        @can('Ads Create')
                        <a href="{{ route('admin.ads.create') }}"  class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Advertise')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="120px">{{ __('page.image')}}</th>
                      <th>{{ __('Name')}}</th>
                      <th>{{ __('Link')}}</th>
                      <th>{{ __('Section where placed')}}</th>
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

@endsection
@push('scripts')

    <script type='module'>
        get_ads_list();
    </script>
@endpush
