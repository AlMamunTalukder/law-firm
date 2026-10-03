@extends('layouts.admin')
@section('title') Edit Activity @endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between"><h3 class="card-title">Edit: {{ $item->title }}</h3><a href="{{ route('admin.activities.index') }}" class="btn btn-secondary btn-sm">Back</a></div>
            <form method="POST" action="{{ route('admin.activities.update',$item->id) }}" enctype="multipart/form-data" class="validate_form">@csrf @method('PUT')
                <div class="card-body">
                    @include('shared.redirect_msg')
                    <div class="row">
                        <div class="col-lg-8">
                            <x-Form::input name="title" value="{{ $item->title }}" label="Title" req="required" />
                            <x-Form::input name="excerpt" value="{{ $item->excerpt }}" label="Short Description" />
                            <label class="fw-bold">Full Description</label>
                            <div style="position:relative; z-index:1;">
                            @include('admin.include.quill_editor',['description'=>$item->description,'inputId'=>'description','inputName'=>'description'])
                            </div>
                            <div class="row mt-3" style="position:relative; z-index:0;">
                                <div class="col-md-6"><x-Form::input type="number" name="order" value="{{ $item->order }}" label="Order" /></div>
                                <div class="col-md-6 d-flex align-items-end"><div class="form-check mb-3"><input type="checkbox" name="status" value="1" {{ $item->status?'checked':'' }} class="form-check-input" id="status"><label for="status" class="form-check-label fw-bold">Active</label></div></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            @include('admin.include.image_div_with_value',['label_name'=>'Cover Image','input_name'=>'image','photo'=>$item->image])
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center" style="position:relative; z-index:5;"><button type="submit" class="btn btn-primary px-4">Update Activity</button></div>
            </form>
        </div>
    </div>
</div>
@endsection
