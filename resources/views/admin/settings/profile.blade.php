@extends('layouts.admin')
@section('title')
{{__('route.profile')}}
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{__('route.profile')}} {{__('page.update')}} {{__('page.form')}}</h3>
                        <div class="card-tools">

                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                        <div class="card-body">
                            @include('shared.redirect_msg')
                            <div class="col-md-6 m-auto">
                                <x-Form::input name="name" autocomplete="off" class="form-control" label="{{__('page.name')}}" value="{{$item->name}}" req="required" />
                                <x-Form::input type="email" name="email" autocomplete="off" class="form-control" label="{{__('page.email')}}" value="{{$item->email}}" req="required" />
                                <x-Form::button type="submit" label="{{__('page.submit')}}"/>
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
<script>
    function password_match_checker()
    {
        var password=$("#password").val();
        var con_password=$("#con_password").val();
        if(password!=con_password)
        {
            $("#submit_btn").prop('disabled',true);
            $("#pass_msg_div").html('<span class="text-danger fw-bold">Password not matched</span>');
        }
        else
        {
            $("#submit_btn").prop('disabled',false);
            $("#pass_msg_div").html('');
        }
    }
</script>
@endpush
