@extends('layouts.admin')
@section('title')
Advertise Add Form
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">New Advertise Add Form</h3>
                        <div class="card-tools">
                            @can('Ads List')
                            <a href="{{ route('admin.ads.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('Advertise List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.ads.store')}}">
                    @csrf
                        <div class="card-body">
                            @include('shared.redirect_msg')
                            <div class="row">
                                <div class="col border-end">
                                    <x-Form::input name="name" label="Advertise Name/Title"  placeholder="Ex: Traveling" autocomplete="off" req="required" />
                                    <x-Form::input  name="link" label="{{__('Advertise Link')}}"  placeholder="Ex: https://xyz.com" autocomplete="off"  />
                                    <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status" default checked  value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            @include('admin.include.image_div_with_value',['label_name'=>'Advertise Image'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="my-3">Check "Section/Place" want to show this advertise
                                                <div class="btn-group float-end">
                                                    <button type="button" class="btn btn-sm bg-teal-500 text-white" id="checkAll">Check All</button>
                                                    <button type="button" class="btn btn-sm bg-orange-500 text-white" id="unCheckAll">Un-Check All</button>
                                                </div>
                                            </h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        @foreach ($sections as $split_section)
                                            <div class="col-md-3">
                                                <ul class="list-group-inline">
                                                    @foreach ($split_section as $section)
                                                        <li class="list-group-item border-0">
                                                            <x-Form::checkbox class="features" labelClass="ms-2" id="{{$section->id}}" helper="{{$section->description}}" name="section_ids[]"   value="{{$section->id}}"  label="{{$section->name}}" />
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col m-auto">
                                    <x-Form::button type="submit" label="{{__('page.submit')}}"/>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
@push('scripts')
    <script type="module">
        $("#checkAll").click(function(){
            $('input.features:checkbox').prop('checked',true);
        });
        $("#unCheckAll").click(function(){
            $('input.features:checkbox').prop('checked',false);
        });
    </script>
@endpush
