@extends('layouts.admin')
@section('title')
Assign {{($type_id==1)?'News':'Image/Video'}} Category to User
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Assign {{($type_id==1)?'News':'Image/Video'}} Category to <span class="text-primary fw-bold">"{{$item->name}}"</span> {{__('page.form')}}</h3>
                        <div class="card-tools">
                            @can('User List')
                            <a href="{{ route('admin.user.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('All Users List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" method="POST" action="{{ route('admin.assigncategory.store',[$type_id,$item->id]) }}">
                    @csrf
                        <div class="card-body">

                            @include('shared.redirect_msg')
                            <div class="row">
                                <div class="col border-end">
                                    <x-Form::input value="{{$item->name}}" name="name" readonly label="{{__('page.name')}}"  />
                                </div>
                                <div class="col">
                                    <x-Form::input value="{{$item->email}}" name="email" readonly type="email"  label="{{__('page.email')}}"  />
                                </div>
                            </div>
                            <div class="row">
                                <h4>Category List</h4>
                                @foreach ($categories as $element)
                                <div class="col-md-3">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0">
                                            @if ($user_categories->contains('category_id',$element->id))
                                                <x-Form::checkbox  labelClass="ms-2" checked id="{{$element->id}}" value="{{$element->id}}" name="categories[]" label="{{$element->name}}" />
                                            @else
                                                <x-Form::checkbox  labelClass="ms-2" id="{{$element->id}}" value="{{$element->id}}" name="categories[]" label="{{$element->name}}" />
                                            @endif
                                        </li>

                                    </ul>
                                </div>
                                @endforeach
                            </div>
                            <x-Form::button class="mt-2" type="submit" label="{{__('page.submit')}}"/>
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
