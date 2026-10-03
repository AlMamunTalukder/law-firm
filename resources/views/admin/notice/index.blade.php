@extends('layouts.admin')
@section('title')
Notice List
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">All Notices</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.notice.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-square"></i> Add New Notice
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('shared.redirect_msg')
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Status</th>
                                        <th>Order</th>
                                        <th>Views</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->status ? 'Active' : 'Inactive' }}</td>
                                            <td>{{ $item->order }}</td>
                                            <td>{{ $item->views }}</td>
                                            <td>
                                                <a href="{{ route('admin.notice.edit', $item->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="javascript:void(0)" onclick="deleteNotice({{ $item->id }})" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function deleteNotice(id) {
    if (!confirm('Are you sure you want to delete this notice?')) return;

    fetch(`{{ url('admin/notice') }}/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
@endpush
