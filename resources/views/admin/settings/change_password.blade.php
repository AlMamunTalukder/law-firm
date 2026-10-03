@extends('layouts.admin')
@section('title')
{{__('page.change_password')}}
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{__('page.change_password')}} {{__('page.form')}}</h3>
                        <div class="card-tools">

                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" method="POST" action="{{ route('admin.change_password.update',auth()->user()->id) }}">
                    @csrf
                    @method('PUT')
                        <div class="card-body">

                            @include('shared.redirect_msg')
                            <div class="col-md-6 m-auto">
                                <x-Form::input type="password" name="current" autocomplete="off"  label="{{__('page.previous_password')}}" req="required" />
                                <x-Form::input  id="new_password" type="password" name="password" autocomplete="off"  label="{{__('page.new_password')}}" req="required" />
                                <x-Form::input  id="con_password" type="password" name="password_confirmation" autocomplete="off"  label="{{__('page.confirm_password')}}"  req="required"/>
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
