@extends('layouts.admin')
@section('title') New Activity @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between"><h3 class="card-title">New Activity</h3><a href="{{ route('admin.activities.index') }}" class="btn btn-secondary btn-sm">Back</a></div>
            <form method="POST" action="{{ route('admin.activities.store') }}" enctype="multipart/form-data" class="validate_form">@csrf
                <div class="card-body">
                    @include('shared.redirect_msg')
                    <div class="row">
                        <div class="col-lg-8">
                            <x-Form::input name="title" label="Title" req="required" placeholder="e.g. Free Madrasa Education" />
                            <x-Form::input name="excerpt" label="Short Description (for card)" placeholder="One line summary shown on cards" />
                            <label class="fw-bold">Full Description <small class="text-muted">(all editor features: tables, images, alignment)</small></label>
                            <div style="position:relative; z-index:1;">
                            @include('admin.include.quill_editor',['description'=>'','inputId'=>'description','inputName'=>'description'])
                            </div>
                            <div class="row mt-3" style="position:relative; z-index:0;">
                                <div class="col-md-6"><x-Form::input type="number" name="order" label="Order" placeholder="0" /></div>
                                <div class="col-md-6 d-flex align-items-end"><div class="form-check mb-3"><input type="checkbox" name="status" value="1" checked class="form-check-input" id="status"><label for="status" class="form-check-label fw-bold">Active</label></div></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @include('admin.include.image_div_with_value',['label_name'=>'Cover Image','input_name'=>'image'])
                            <div class="alert alert-info small mt-3">Card image — recommended 800x500, JPG/WebP.</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center" style="position:relative; z-index:5;"><button type="submit" class="btn btn-success px-4">Save Activity</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
