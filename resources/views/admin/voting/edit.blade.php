@extends('layouts.admin')
@section('title')
Voting Edit Form
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Voting Edit {{__('page.form')}}</h3>
                        <div class="card-tools">
                            @can('Voting List')
                            <a href="{{ route('admin.voting.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('All Vote/Polling List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" method="POST" action="{{ route('admin.voting.store') }}">
                    @csrf
                        <div class="card-body">

                            @include('shared.redirect_msg')
                            <div class="row">
                                <div class="col border-end">
                                    <input type="hidden" name="table_id" value="{{$item->id}}">
                                    <x-Form::input value="{{$item->name}}" name="name" autocomplete="off" label="{{__('Question')}}" req="required" />
                                    <x-Form::input-group
                                        groupClass="date_picker"
                                        data-input
                                        name="action_date" icon_class="fas fa-calendar"
                                        req="required" label="{{__('Polling Date')}}"
                                        placeholder="{{__('page.date')}}"
                                        value="{{$item->action_date}}"
                                    />
                                    @if ($item->status)
                                    <x-Form::checkbox helper="check is active and uncheck is for Inactive" class="status" name="status" checked value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                    @else
                                    <x-Form::checkbox helper="check is active and uncheck is for Inactive" class="status" name="status"   value="1"  label="{{__('page.active')}}/{{__('page.inactive')}}" />
                                    @endif

                                    <x-Form::button type="submit" label="{{__('page.submit')}}"/>
                                </div>
                                <div class="col">
                                    <x-Form::input value="{{$item->option1}}" name="option1" autocomplete="off" label="{{__('Option 1')}}" req="required" />
                                    <x-Form::input value="{{$item->option2}}" name="option2" autocomplete="off" label="{{__('Option 2')}}" req="required" />
                                    <x-Form::input value="{{$item->option3}}" name="option3" autocomplete="off" label="{{__('Option 3')}}" req="required" />

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
