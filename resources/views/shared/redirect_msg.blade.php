@if (Session::has('scc_msg') || (Session::has('err_msg')) || $errors->any())
<div class="row">
    <div class="col-12">
        @if (Session::has('scc_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('scc_msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('err_msg'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('err_msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $item)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! $item !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endif
