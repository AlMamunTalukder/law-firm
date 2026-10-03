@extends('layouts.admin')
@section('title') Message Details @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <a href="{{ route('admin.contact_messages.index') }}" class="btn btn-secondary btn-sm mb-3">← Back to List</a>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Message from {{ $item->name }}</h3><span
                    class="float-end badge {{ $item->is_read?'bg-success':'bg-warning' }}">{{ $item->is_read?'Read':'New' }}</span>
            </div>
            <div class="card-body">
                <p>
                    <strong>Name:</strong> {{ $item->name }}
                </p>
                <p><strong>Email:</strong> <a href="mailto:{{ $item->email }}">{{ $item->email }}</a></p>
                <p><strong>Phone:</strong> {{ $item->phone ?? '—' }}</p>
                <p><strong>Subject:</strong> {{ $item->subject }}</p>
                <p><strong>Date:</strong> {{ $item->created_at->format('d M Y h:i A') }}</p>
                <hr>
                <p><strong>Message:</strong></p>
                <div
                    style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:16px; white-space:pre-wrap;">
                    {{ $item->message }}</div>
            </div>
        </div>
    </div>
</div>
@endsection