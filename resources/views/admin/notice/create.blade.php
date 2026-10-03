@extends('layouts.admin')
@section('title')
Add Notice
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <form method="POST" action="{{ route('admin.notice.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Create Notice</h3>
                </div>
                <div class="card-body">
                    @include('shared.redirect_msg')
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                @include('admin.include.quill_editor', [
                                    'description' => old('content'),
                                    'inputId' => 'content',
                                    'inputName' => 'content'
                                ])
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Order</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ route('admin.notice.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
