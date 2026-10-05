@extends('layouts.admin')
@section('title')
Website Settings Form
@endsection
@section('content')
<div class="content">
    <form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.website_info.update')}}">
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
                        <h2 class="text-center fw-bold">Center Image Section</h2>
                        <div class="row">
                            <div class="col-md-4">
                                <x-Form::input type="number" name="teachers" value="{{$item->teachers}}" autocomplete="off"  placeholder="Ex: Total Advocates" label="{{__('Advocates Number')}}" req="required" />
                                <x-Form::input type="number" name="male_students" value="{{$item->male_students}}" autocomplete="off"  placeholder="Ex: Total Male Students" label="{{__('Male Students Number')}}" req="required" />
                                <x-Form::input type="number" name="female_students" value="{{$item->female_students}}" autocomplete="off"  placeholder="Ex: Total Female Students" label="{{__('Female Students Number')}}" req="required" />
                            </div>
                            <div class="col-md-4">
                               @include('admin.include.image_div_with_value',['label_name'=>'About Center Image (Home Page)','input_name'=>'about_center_image','photo'=>$item->about_center_image])
                            </div>
                            <div class="col-md-4">
                                <x-Form::input type="number" name="alumni" value="{{$item->alumni}}" autocomplete="off"  placeholder="Ex: Total Alumni" label="{{__('Total Alumni Number')}}" req="required" />
                                <x-Form::input type="number" name="staffs" value="{{$item->staffs}}" autocomplete="off"  placeholder="Ex: Total Staffs" label="{{__('Total Staffs')}}" req="required" />
                               <x-Form::input type="number" name="donors" value="{{$item->donors}}" autocomplete="off"  placeholder="Ex: Total Donors" label="{{__('Total Donors Number')}}" req="required" />
                            </div>
                        </div>
                        <hr>
                        <h2 class="text-center fw-bold">Footer Section</h2>
                        <div class="row">
                            <div class="col-md-6">
                                 <x-Form::input type="email" name="email" value="{{$item->email}}" autocomplete="off"  placeholder="Ex: Website Email" label="{{__('Enter Website Email')}}"  />
                            </div>
                            <div class="col-md-6">
                                 <x-Form::input type="number" name="phone" value="{{$item->phone}}" autocomplete="off"  placeholder="Ex: Website phone" label="{{__('Enter Website phone')}}"  />
                            </div>
                        </div>
                        @include('admin.include.image_div_with_value',['label_name'=>'Footer Connect Image','input_name'=>'footer_connect_image','photo'=>$item->footer_connect_image])
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
                        <h3 class="card-title">About Website</h3>
                    </div>

                    <div class="card-body">
                        <x-Form::input  name="about_title" value="{{$item->about_title}}" autocomplete="off"  placeholder="Ex: ড্রীম হোমস বাংলাদেশের অসহায় শিশুদের জন্য আশা ও সুরক্ষার নিবাস" label="{{__('Title of About Info')}}" req="required" />
                        @include('admin.include.image_div_with_value',['label_name'=>'About Info Image (Details Page)','input_name'=>'about_image','photo'=>$item->about_image])

                        @include('admin.include.quill_editor',['description'=> $item->about??null])
                    </div>

                </div>

            </div>
        </div>

    </div>

</form>
</div>
@endsection
