@extends('layouts.admin')
@section('title')
<h1 class="text-danger text-center">Access Declined</h1>
@endsection
@section('code', '403')
@section('content')
    <h4 class="text-primary text-center">{{ __($exception->getMessage() ?: 'You have not permission to access this.')}}</h4>
@endsection
