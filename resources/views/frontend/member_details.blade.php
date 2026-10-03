@extends('layouts.frontend')
@section('title', $item->name ?? 'Member')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-4 text-center">
                    @if($item->photo)
                        <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}" class="rounded-circle mb-3" style="width:160px;height:160px;object-fit:cover;">
                    @endif
                    <h2>{{ $item->name }}</h2>
                    @if($item->designations && $item->designations->count())
                        <h5 class="text-muted">{{ $item->designations->pluck('designation.name')->filter()->implode(', ') }}</h5>
                    @endif
                    @if($item->description)
                        <div class="mt-3 text-start rich-content" style="color:#334155; line-height:1.75; font-size:15px;">{!! $item->description !!}</div>
                        <style>.rich-content .ql-align-center{text-align:center;}.rich-content .ql-align-right{text-align:right;}.rich-content .ql-align-justify{text-align:justify;}.rich-content table{border-collapse:collapse; width:100%; margin:12px 0;} .rich-content td,.rich-content th{border:1px solid #cbd5e1; padding:8px;} .rich-content img{max-width:100%; height:auto; border-radius:8px;} .rich-content blockquote{border-left:4px solid #c9962a; margin:12px 0; padding:8px 16px; color:#475569;}</style>
                    @endif
                    <div class="mt-3 small text-muted">
                        @if($item->phone_no)<span class="me-3"><i class="fas fa-phone me-1"></i>{{ $item->phone_no }}</span>@endif
                        @if($item->email)<span class="me-3"><i class="fas fa-envelope me-1"></i>{{ $item->email }}</span>@endif
                    </div>
                    <div class="mt-2">
                        @if($item->facebook)<a href="{{ $item->facebook }}" target="_blank" class="btn btn-sm btn-outline-primary me-1"><i class="fab fa-facebook"></i></a>@endif
                        @if($item->twitter)<a href="{{ $item->twitter }}" target="_blank" class="btn btn-sm btn-outline-primary me-1"><i class="fab fa-twitter"></i></a>@endif
                        @if($item->linkedin)<a href="{{ $item->linkedin }}" target="_blank" class="btn btn-sm btn-outline-primary me-1"><i class="fab fa-linkedin"></i></a>@endif
                        @if($item->link)<a href="{{ $item->link }}" target="_blank" class="btn btn-sm btn-outline-secondary">Website</a>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
