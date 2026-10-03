@extends('layouts.admin')
@section('title')
Category Add Form
@endsection
@section('content')
<div class="content">
    <form class="form-horizontal validate_form" role="form" enctype="multipart/form-data" method="POST"
        action="{{ route('admin.category.store')}}">
        @csrf
        <div class="container-fluid">
            @include('shared.redirect_msg')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Basic Info</h3>
                            <div class="card-tools">
                                @can('Category List')
                                <a href="{{ route('admin.category.index') }}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-list"></i>&nbsp;{{__('Category List')}}</a>
                                @endcan
                            </div>
                        </div>

                        <div class="card-body">
                            <x-Form::input name="name" label="{{__('route.category')}} {{__('page.name')}}"
                                placeholder="Ex: খেলাধুলা" autocomplete="off" req="required" />
                            <x-Form::input small="(Please enter the url name in english)" name="slug"
                                label="{{__('URL Name')}}" placeholder="Ex: sports (Must be in english)"
                                autocomplete="off" req="required" />
                            <input type="hidden" name="type" value="1">
                            <x-Form::input name="icon" helper="Use Fontawesome or boxicons"
                                placeholder="Ex: fas fa-list" autocomplete="off" label="{{__('Icon Class Name')}}" />

                            <x-Form::checkbox name="is_single_news" helper="check is for Menu is for Single News"
                                class="status" label="Is Single News" />
                            <x-Form::select placeholder="Choose news" name="news_url" id="news_url" class="select2"
                                label="News {{__('URL')}}" :options="$news_list" />

                            <x-Form::input type="number" name="order" label="{{__('Order/Position')}}"
                                placeholder="Ex: 2" autocomplete="off" req="required" />
                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status" default
                                checked value="1" label="{{__('page.active')}}/{{__('page.inactive')}}" />
                            <x-Form::button type="submit" label="{{__('page.submit')}}" />
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
                            @foreach ($sections as $key => $section)
                            @if ($key==0)
                            <x-Form::checkbox labelClass="ms-2" class="features" id="{{$section->id}}"
                                helper="{{$section->description}}" name="section_ids[]" value="{{$section->id}}"
                                label="{{$section->name}}" />
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
                            <x-Form::input name="meta_title" autocomplete="off" label="{{__('Meta Title')}}" />
                            <x-Form::input name="meta_keyword" autocomplete="off" label="{{__('Meta Keyword')}}" />
                            <x-Form::textarea name="meta_description" autocomplete="off"
                                label="{{__('Meta Description')}}" />
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