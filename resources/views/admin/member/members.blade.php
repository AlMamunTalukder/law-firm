@extends('layouts.admin')
@section('title')
{{ __('route.members_list')}}
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} {{ __('Members List')}}</h3>
                    <div class="card-tools">
                        @can('Member Create')
                        <a href="{{ route('admin.member.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.add')}} {{__('page.new')}} {{__('Member')}}</a>
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

@endsection
@push('scripts')
    <script type='module'>
        get_common_list('member');
    </script>
@endpush
