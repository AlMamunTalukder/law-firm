@extends('layouts.admin')
@section('title')
Vote/Polling List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Vote/Polling List <small class="text-indigo-700 fw-bold"> (Latest "active" polling will be shown in frontend")</small></h3>
                    <div class="card-tools">
                        @can('Voting Create')
                        <a href="{{ route('admin.voting.create') }}"  class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('Vote/Polling')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('Question')}}</th>
                      <th>{{ __('Options')}}</th>
                      <th>{{ __('page.date')}}</th>
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
        get_voting_list();
    </script>
@endpush
