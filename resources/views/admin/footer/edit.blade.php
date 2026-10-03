@extends('layouts.admin')
@section('title')
{{$item->name}} Edit Form
@endsection
@section('content')
<div class="content">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{$item->name}} Edit Form</h3>
                        <div class="card-tools">
                            @can('Footer Widget Update')
                            <a href="{{ route('admin.footer.index') }}"  class="btn btn-primary btn-sm"><i class="fa fa-list"></i>&nbsp;{{__('Footer Widget List')}}</a>
                            @endcan
                        </div>
                    </div>

                    <form class="form-horizontal validate_form"  role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.footer.update',$item->id)}}">
                    @csrf
                    @method('PUT')
                        <div class="card-body">
                            @include('shared.redirect_msg')
                            @php $type = 1;@endphp
                            @if (!$items->isEmpty())
                                @php $type = $items[0]->type;@endphp
                            @endif
                            <div class="row">
                                <div class="col text-center">
                                    <h4 class="text-primary">Choose a "Content type" for your footer widgets</h4>
                                    @if ($type==1)
                                        <x-Form::radio checked labelClass="ms-2 mt-1" groupClass="form-check-inline" class="content_type" name="type" id="link_base" value="1" label="Link Base Content"/>
                                        <x-Form::radio labelClass="ms-2 mt-1" groupClass="form-check-inline" class="content_type" name="type" id="content_base" value="2" label="Description Base Content"/>
                                    @else
                                        <x-Form::radio  labelClass="ms-2 mt-1" groupClass="form-check-inline" class="content_type" name="type" id="link_base" value="1" label="Link Base Content"/>
                                        <x-Form::radio checked labelClass="ms-2 mt-1" groupClass="form-check-inline" class="content_type" name="type" id="content_base" value="2" label="Description Base Content"/>
                                    @endif

                                </div>
                            </div>

                            <div class="row" style="min-height:370px">
                                <div class="col border-end">
                                    <div id="link_base_div"  @if ($type==2) style="display: none" @endif>

                                        <table class="table table-light table-bordered table-striped" id="footer_table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>SL.</th>
                                                    <th>Name/Title</th>
                                                    <th>Link</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!$items->isEmpty() && $type==1)
                                                @foreach ($items as $footer)
                                                <tr class="tr_clone">
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><input value="{{$footer->name}}" type="text" name="name[]" required="required" class="form-control form-control-sm"></td>
                                                    <td><input value="{{$footer->link}}" type="text" name="link[]" required="required" class="form-control form-control-sm"></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn-sm btn btn-success add_row"><i class="fas fa-plus"></i></a>
                                                        <a href="javascript:void(0)" class="btn-sm btn btn-danger remove_row"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr class="tr_clone">
                                                    <td>1</td>
                                                    <td><input type="text" name="name[]" required="required" class="form-control form-control-sm"></td>
                                                    <td><input type="text" name="link[]" required="required" class="form-control form-control-sm"></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn-sm btn btn-success add_row"><i class="fas fa-plus"></i></a>
                                                        <a href="javascript:void(0)" class="btn-sm btn btn-danger remove_row"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col">
                                    <div id="content_base_div" @if ($type==1) style="display: none" @endif >
                                        @if ($type==2)
                                            @include('admin.include.quill_editor',['description'=>$items[0]->name])
                                        @else
                                            @include('admin.include.quill_editor')
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col text-center">
                                    <x-Form::button class="mt-2" type="submit" label="{{__('page.update')}} Footer Widget"/>
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
    <script type="module">

    $(".content_type").change(function(){
        $("#link_base_div").fadeOut();
        $("#content_base_div").fadeOut();
        if( $(this).is(":checked") ){
            let id=$(this).attr('id');
            $(`#${id}_div`).fadeIn();
        }
    });

        $('#footer_table').on('click', '.add_row', function() {
            var $tableBody = $('#footer_table').find("tbody"),
            $trLast = $tableBody.find(".tr_clone:last"),
            $trNew = $trLast.clone();
            $trNew.find('input').val('');
            $trLast.after($trNew);

            $('#footer_table tbody .tr_clone').each(function(idx){
                $(this).children(":eq(0)").html(idx + 1);
            });
        });

        $('#footer_table').on('click', '.remove_row', function(e) {
            let row_num =0;
            $('#footer_table .tr_clone').each(function(idx){
                row_num=idx;
            });
            if(row_num>=1)
            {
                $(this).parents(".tr_clone").remove();
            }
            else
            {
                toast_alert('info',cancel_title,first_row_data);
            }
        });
    </script>
@endpush
