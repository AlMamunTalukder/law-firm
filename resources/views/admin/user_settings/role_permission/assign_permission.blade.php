@extends('layouts.admin')
@section('title')
Assign Permission to Role
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Assign permission to <span class="text-indigo-600 fw-bold">"{{$item->name}}"</span> role</h3>
                        <div class="card-tools">

                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" method="POST" action="{{ route('admin.assign_permission_to_role.store',$item->id) }}">
                    @csrf
                        <div class="card-body">

                            @include('shared.redirect_msg')
                            <h2>Permissions
                                <div class="btn-group float-end">
                                    <button type="button" class="btn bg-teal-500 text-white" id="checkAll">Check All</button>
                                    <button type="button" class="btn bg-orange-500 text-white" id="unCheckAll">Un-Check All</button>
                                </div>
                            </h2>
                            <div class="row">
                                @foreach ($permissions as $group)
                                <div class="col-md-3">
                                    <div class="shadow-sm">
                                        <h5 class="mt-4 mb-0 p-3 bg-cyan-100 text-cyan-700 fw-bold">{{$group[0]->permission_feature?$group[0]->permission_feature->name:''}}</h5>
                                        <ul class="list-group">
                                            @foreach ($group as $permission)
                                            <li class="list-group-item border-0">
                                                @if ($has_permissions->contains('id',$permission->id))
                                                <x-Form::checkbox class="permissions" labelClass="ms-2" id="{{$permission->id}}" value="{{$permission->name}}" checked name="permissions[]" label="{{$permission->name}}" /></li>
                                                @else
                                                <x-Form::checkbox class="permissions" labelClass="ms-2" id="{{$permission->id}}" value="{{$permission->name}}" name="permissions[]" label="{{$permission->name}}" /></li>
                                                @endif

                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <x-Form::button class="mt-3" type="submit" label="{{__('page.submit')}}"/>
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
            $('input.permissions:checkbox').prop('checked',true);
        });
        $("#unCheckAll").click(function(){
            $('input.permissions:checkbox').prop('checked',false);
        });
    </script>
@endpush
