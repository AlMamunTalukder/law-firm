@extends('layouts.admin')
@section('title')
Sub-Category Edit Form
@endsection
@section('content')
<div class="content">
    <form class="form-horizontal validate_form" role="form" enctype="multipart/form-data" method="POST"
        action="{{ route('admin.subcategory.store')}}">
        @csrf
        <div class="container-fluid">
            @include('shared.redirect_msg')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Sub-Category Basic Info</h3>
                            <div class="card-tools">
                                @can('Subcategory List')
                                <a href="{{ route('admin.subcategory.index') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-list"></i>&nbsp;{{__('News Sub-Category List')}}</a>
                                @endcan
                            </div>
                        </div>

                        <div class="card-body">

                            <x-Form::input value="{{$item->name}}" name="name"
                                label="{{__('route.category')}} {{__('page.name')}}" placeholder="Ex: ক্রিকেট"
                                autocomplete="off" req="required" />

                            <x-Form::select name="category_id" class="select2"
                                label="{{__('route.category')}} {{__('page.name')}}" :default="[$item->category_id]"
                                :options="$categories" req="required" />
                            <x-Form::input value="{{$item->slug}}" small="(Please enter the url name in english)"
                                name="slug" label="{{__('URL Name')}}" placeholder="Ex: cricket (Must be in english)"
                                autocomplete="off" req="required" />
                            <input type="hidden" name="type" value="1">
                            <input type="hidden" name="table_id" value="{{$item->id}}">
                            <x-Form::input name="icon" value="{{$item->icon}}" helper="Use Fontawesome or boxicons"
                                placeholder="Ex: fas fa-list" autocomplete="off" label="{{__('Icon Class Name')}}" />

                            <x-Form::input type="number" value="{{$item->order}}" name="order"
                                label="{{__('Order/Position')}}" placeholder="Ex: 2" autocomplete="off"
                                req="required" />
                            @if ($item->status)
                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status"
                                class="status" checked value="1"
                                label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            @else
                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status"
                                class="status" value="1" label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            @endif
                            <x-Form::button type="submit" label="{{__('page.update')}}" />
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-primary card-outline mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Features</h3>
                            <div class="btn-group float-end">
                                <button type="button" class="btn btn-sm bg-teal-500 text-white" id="checkAll">Check
                                    All</button>
                                <button type="button" class="btn btn-sm bg-orange-500 text-white"
                                    id="unCheckAll">Un-Check All</button>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach ($sections as $key=>$section)
                            @if ($key==0)
                            @if (in_array($section->id,$cat_sections))
                            <x-Form::checkbox class="features" labelClass="ms-2" id="{{$section->id}}"
                                helper="{{$section->description}}" name="section_ids[]" checked value="{{$section->id}}"
                                label="{{$section->name}}" />
                            @else
                            <x-Form::checkbox class="features" labelClass="ms-2" id="{{$section->id}}"
                                helper="{{$section->description}}" name="section_ids[]" value="{{$section->id}}"
                                label="{{$section->name}}" />
                            @endif
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">SEO Info</h3>
                        </div>

                        <div class="card-body">
                            <x-Form::input value="{{$item->meta_title}}" name="meta_title" autocomplete="off"
                                label="{{__('Meta Title')}}" />
                            <x-Form::input value="{{$item->meta_keyword}}" name="meta_keyword" autocomplete="off"
                                label="{{__('Meta Keyword')}}" />
                            <x-Form::textarea value="{{$item->meta_description}}" name="meta_description"
                                autocomplete="off" label="{{__('Meta Description')}}" />
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </form>

</div>
@endsection
@push('scripts')
<script type="module">
$("#checkAll").click(function() {
    $('input.features:checkbox').prop('checked', true);
});
$("#unCheckAll").click(function() {
    $('input.features:checkbox').prop('checked', false);
});
</script>
@endpush