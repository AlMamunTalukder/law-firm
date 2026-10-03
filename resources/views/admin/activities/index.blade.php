@extends('layouts.admin')
@section('title') Activities @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Our Activities</h3>
                <a href="{{ route('admin.activities.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New Activity</a>
            </div>
            <div class="card-body">
                @include('shared.redirect_msg')
                @section('table_head')
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Action</th>
                @endsection
                @include('admin.include.table')
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="module">
function get_activity_list(){ $('#api_datatable').DataTable({ processing:true, serverSide:true, destroy:true, retrieve:true, ajax: `${APP_URL}/activities?`+$.param({}), columns:[ {render:(d,t,r,m)=>m.row+m.settings._iDisplayStart+1}, {data:'image', name:'image', orderable:false, searchable:false}, {data:'title', name:'title'}, {data:'status_badge', name:'status'}, {data:'order', name:'order'}, {data:'action', name:'action', orderable:false, searchable:false} ], pageLength:25, responsive:true }); }
window.get_activity_list = get_activity_list;
get_activity_list();
</script>
@endpush
