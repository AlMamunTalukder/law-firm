@extends('layouts.admin')
@section('title')
Member Create Form
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{__('page.new')}} Member Create {{__('page.form')}}</h3>
                        <div class="card-tools">
                            @can('Member List')
                            <a href="{{ route('admin.member.store') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('All Member List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form" enctype="multipart/form-data"  role="form" method="POST" action="{{ route('admin.member.store') }}">
                    @csrf
                        <div class="card-body">

                            @include('shared.redirect_msg')
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="table_id" value="{{$item->id}}">
                                    <div class="row">
                                        <div class="col">
                                            <x-Form::input value="{{$item->name}}" name="name" label="{{__('page.name')}}"  placeholder="Ex: Mr. John" autocomplete="off" req="required" />
                                        </div>
                                        <div class="col">
                                            <x-Form::input value="{{$item->email}}" type="email" name="email" label="{{__('page.email')}}"  placeholder="Ex: abc@example.com" autocomplete="off"  />
                                        </div>
                                    </div>
                                    <x-Form::select :default="$member_designation" multiple data-placeholder="{{__('page.choose_option')}}" label="{{__('page.designation')}}" class="select2" name="designation_ids[]" req="required" :options="$designations" />
                                    <div class="row">
                                        <div class="col">
                                            <x-Form::input value="{{$item->phone_no}}" type="number" name="phone_no" label="{{__('page.phone')}}"  placeholder="01XXXXXXXXX" autocomplete="off"  />
                                            <x-Form::input-group
                                                groupClass="date_picker"
                                                data-input
                                                name="date_of_birth" icon_class="fas fa-calendar"
                                                    label="{{__('Born')}}"
                                                placeholder="{{__('page.dob')}}"
                                                value="{{$item->date_of_birth}}"
                                            />
                                            <x-Form::input
                                            name="facebook"
                                            label="{{__('Facebook')}}"
                                            value="{{$item->facebook}}"
                                            placeholder="Ex: https://www.facebook.com/"

                                             />
                                            <x-Form::input name="twitter" label="{{__('Twitter')}}" value="{{$item->twitter}}" placeholder="Ex: https://twitter.com/"   />
                                            <x-Form::input name="linkedin" label="{{__('Linkedin')}}" value="{{$item->linkedin}}" placeholder="Ex: https://www.linkedin.com/"   />
                                        </div>
                                        <div class="col">
                                            @include('admin.include.image_div_with_value',['photo'=>$item->photo])
                                        </div>
                                    </div>

                                        <x-Form::button type="submit" label="{{__('page.submit')}}"/>
                                </div>
                                <div class="col">

                                    @include('admin.include.quill_editor',['description'=>$item->description])
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
