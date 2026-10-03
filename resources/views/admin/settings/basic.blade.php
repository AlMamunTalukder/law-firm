@extends('layouts.admin')
@section('title')
Website Settings Form
@endsection
@section('content')
<div class="content">
    <form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.setting.update')}}">
        @csrf
	<div class="container-fluid">
        @include('shared.redirect_msg')
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Basic Settings</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <x-Form::input name="name" value="{{$item->name}}" autocomplete="off"  placeholder="Ex: Al-Masque Foundation" label="{{__('Website Name')}}" req="required" />
                            </div>
                            <div class="col">
                                <x-Form::input name="phone" value="{{$item->phone}}" autocomplete="off"  placeholder="Ex: +8801712345678" label="{{__('Website Phone')}}" req="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <x-Form::input name="title" value="{{$item->title}}" autocomplete="off" placeholder="Al Masjed" label="{{__('Website Title')}}" req="required" />
                            </div>
                            <div class="col">
                                <x-Form::input name="short_name" value="{{$item->short_name}}" autocomplete="off"  placeholder="Ex: AM Foundation" label="{{__('Website Short Name')}}" req="required" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <x-Form::input name="bottom_carousel_title" value="{{$item->bottom_carousel_title}}" autocomplete="off" placeholder="Photo Gallery" label="{{__('Bottom carousel title')}}" />
                            </div>
                            <div class="col">
                                <x-Form::input name="copyright" value="{{$item->copyright}}" autocomplete="off"  placeholder="Ex: Copyright © 2024  Al Masjid Foundation Bangladesh. All rights reserved." label="{{__('Website Copyright')}}"  />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                @include('admin.include.image_div_with_value',['label_name'=>'Website Logo','input_name'=>'logo','photo'=>$item->logo])
                            </div>
                            <div class="col">
                                @include('admin.include.image_div_with_value',['label_name'=>'Website Favicon','input_name'=>'favicon','photo'=>$item->favicon,'resolution_sugg'=>'(64x64)px will be perfect size'])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                @include('admin.include.image_div_with_value',['label_name'=>'Login Form','input_name'=>'admin_logo','photo'=>$item->admin_logo])
                            </div>
                            <div class="col">
                                @include('admin.include.image_div_with_value',['label_name'=>'Footer Logo','input_name'=>'footer_logo','photo'=>$item->footer_logo])
                            </div>
                            <div class="col">
                                @include('admin.include.image_div_with_value',['label_name'=>'Scroll Top Image','input_name'=>'scroll_top','photo'=>$item->scroll_top])
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col text-center">
                                <x-Form::button type="submit" label="{{__('page.update')}} Settings"/>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Menu Settings</h3>
                    </div>

                    <div class="card-body">
                        <x-Form::input type="color" class="form-control-color" value="{{$item->footer_body_background_color}}" name="footer_body_background_color" autocomplete="off" label="{{__('Footer Body Background Color')}}" />

                    </div>

                </div>

                <div class="card card-danger mt-3 card-outline d-none">
                    <div class="card-header">
                        <h3 class="card-title">SEO Settings</h3>
                    </div>

                    <div class="card-body">
                        <x-Form::input value="{{$item->meta_title}}" name="meta_title" autocomplete="off" label="{{__('Meta Title')}}" />
                        <x-Form::input value="{{$item->meta_keyword}}" name="meta_keyword" autocomplete="off" label="{{__('Meta Keyword')}}" />
                        <x-Form::textarea value="{{$item->meta_description}}" name="meta_description" autocomplete="off" label="{{__('Meta Description')}}" />
                    </div>

                </div>
            </div>
        </div>

    </div>

</form>
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
