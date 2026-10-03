@extends('layouts.frontend')
@section('title')
<h1 class="text-danger text-center">Page Expired</h1>
@endsection
@section('code', '403')
@section('content')

<h2 class="mt-3 number text-center">Page Expired</h2>
<h4 class="p-3 text-danger text-center">Your session has expired.Please Login to continue.</h4>
<div class="p-3 text-center m-auto"><a class="btn btn-primary" href="{{ route('login') }}">Login</a></div>

@endsection
