@extends('layouts.admin')
@section('title')
User List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">User List</h3>
                    <div class="card-tools">
                        @can('User Create')
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.add')}} {{__('page.new')}} {{__('User')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th>{{ __('page.email')}}</th>
                      <th>{{ __('route.role')}}/{{ __('page.type')}}</th>
                      <th width="500px">{{ __('page.action')}}</th>
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
        get_user_list();
    </script>
@endpush
