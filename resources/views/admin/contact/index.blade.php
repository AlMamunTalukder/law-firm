@extends('layouts.admin')
@section('title') Contact Messages @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Contact Messages ({{ $items->total() }})</h3>
            </div>
            <div class="card-body p-0">
                @include('shared.redirect_msg')
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $it)
                            <tr>
                                <td>{{ $it->id }}</td>
                                <td>{{ $it->name }}</td>
                                <td>{{ $it->email }}</td>
                                <td>{{ Str::limit($it->subject,30) }}</td>
                                <td>{{ $it->created_at->format('d M Y h:i A') }}</td>
                                <td>@if($it->is_read)<span class="badge bg-success">Read</span>@else<span
                                        class="badge bg-warning">New</span>@endif</td>
                                <td><a href="{{ route('admin.contact_messages.show',$it->id) }}"
                                        class="btn btn-sm btn-info">View</a> <button
                                        onclick="delMsg({{ $it->id }}, this)"
                                        class="btn btn-sm btn-danger">Delete</button></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No messages yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3 d-flex justify-content-center">{{ $items->links('pagination::bootstrap-5') }}</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
function delMsg(id, btn) {
    if (!confirm('Delete this message?')) return;
    fetch("{{ url('admin/contact-messages') }}/" + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(r => r.json()).then(j => {
            if (j.success) {
                btn.closest('tr').remove();
            } else alert('Failed');
        });
}
</script>
@endpush
@endsection