@extends('layouts.admin')
@section('title')
Location Edit Form
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ $item->name }} Location Edit Form</h3>
                        <div class="card-tools">
                            @can('Location List')
                            <a href="{{ route('admin.location.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('Location List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.location.store')}}">
                    @csrf
                        <div class="card-body">
                            @include('shared.redirect_msg')
                            <div class="row">
                                <div class="col border-end">
                                   <input type="hidden" name="table_id" value="{{$item->id}}">
                                    <x-Form::input name="name" value="{{$item->name}}" label="Location Name/Title"  placeholder="Ex: Traveling" autocomplete="off" req="required" />

                                    <div class="row">
                                        <div class="col">
                                            <x-Form::textarea name="map_link" value="{!! $item->map_link !!}" label="Map Link"  placeholder="Google Map Iframe Link" autocomplete="off" />
                                            <x-Form::input type="number" value="{{ $item->order }}" name="order" label="Order Number"  placeholder="1" autocomplete="off" />
                                        </div>
                                        <div class="col">
                                             @if ($item->status)
                                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status" class="status" checked  value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                            @else
                                            <x-Form::checkbox helper="check is active and uncheck is for Inactive" name="status" class="status"   value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                            @endif
                                        </div>
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
