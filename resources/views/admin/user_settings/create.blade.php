@extends('layouts.admin')
@section('title')
User Create Form
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{__('page.new')}} User Create {{__('page.form')}}</h3>
                        <div class="card-tools">
                            @can('User List')
                            <a href="{{ route('admin.user.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('All Users List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" method="POST" action="{{ route('admin.user.store') }}">
                    @csrf
                        <div class="card-body">

                            @include('shared.redirect_msg')
                            <div class="row">
                                <div class="col border-end">
                                    <x-Form::input name="name" autocomplete="off" label="{{__('page.name')}}" req="required" />
                                    <x-Form::input type="email" name="email" autocomplete="off" label="{{__('page.email')}}" req="required" />
                                    <x-Form::input type="password" name="password" autocomplete="off" label="{{__('page.password')}}" req="required" />
                                    <x-Form::button type="submit" label="{{__('page.submit')}}"/>
                                </div>
                                <div class="col">
                                    <h4>Role</h4>
                                    <ul class="list-group">
                                        @foreach ($roles as $element)
                                        <li class="list-group-item border-0">

                                            <x-Form::checkbox  labelClass="ms-2" id="{{$element->id}}" value="{{$element->name}}" name="roles[]" label="{{$element->name}}" /></li>
                                        @endforeach
                                    </ul>
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

@endpush
