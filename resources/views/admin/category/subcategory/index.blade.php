@extends('layouts.admin')
@section('title')
News Sub-Category List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} News Sub-Category List</h3>
                    <div class="card-tools">
                        @can('Subcategory Create')
                            <a href="{{ route('admin.subcategory.create') }}"  class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>&nbsp;{{__('page.new')}} {{__('News Sub-Category')}}</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    @section('table_head')
                      <th>{{ __('page.sl')}}</th>
                      <th width="200px">{{ __('page.name')}}</th>
                      <th>{{ __('Page Name/URL Name')}}</th>
                      <th>{{ __('Category Name')}}</th>
                      <th>{{ __('page.features')}}</th>
                      <th>{{ __('Position')}}</th>
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
        setTimeout(() => {
            $( ".sortable_table_contents" ).sortable({
                items: "tr",
                cursor: 'grabbing',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer('Category');
                }
            });
        }, 100);
        get_subcategory_list();
    </script>
@endpush
