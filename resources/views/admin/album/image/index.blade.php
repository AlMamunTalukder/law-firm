@extends('layouts.admin')
@section('title')
Album Image List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Album Image List</h3>
                    <div class="card-tools">
                        @can('Album Image Create')
                        <a href="{{ route('admin.album_image.create') }}"  class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Album Image')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th>{{ __('Photo')}}</th>
                      <th>{{ __('Categories')}}</th>
                      <th>{{ __('Features')}}</th>
                      <th>{{ __('page.date')}}</th>
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
        get_album_image_list();
    </script>
@endpush
