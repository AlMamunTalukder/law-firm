@extends('layouts.admin')
@section('title')
Footer Widget
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('page.all')}} Footer Widget </h3>
                    <div class="card-tools">

                    </div>
                </div>

                <div class="card-body">
                    @include('shared.redirect_msg')

                    <table class="table table-bordered table-striped">
                        <thead>
                           <tr>
                                <th>SL</th>
                                <th>Footer Blocks Name</th>
                                <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <a href="{{ route('admin.footer.edit',$item->id) }}" class="btn-sm text-white btn btn-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            </div>

        </div>

    </div>

</div>

@endsection
