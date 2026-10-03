@extends('layouts.frontend')
@section('title') {{ $category->name ?? 'Gallery' }} @endsection
@section('content')
<div class="content">
<section class="gallery-area" style="padding:40px 0;">
    <div class="container">
        <div class="section-heading text-center" data-aos="fade-down">
            <h3>{{ $category->name }}</h3>
            <a href="{{ route('image') }}" style="font-size:13px; color:#64748b; text-decoration:none;">← Back to Gallery</a>
        </div>
        <div class="image-gallery-grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:16px;">
            @forelse($items as $item)
            <div class="gallery-single-item" data-aos="zoom-in">
                <a href="{{ asset('storage/'.$item->photo) }}" class="lightbox_click" data-lightbox="gallery-cat" data-title="{{ $item->name }}">
                    <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}" style="width:100%; height:200px; object-fit:cover; border-radius:12px; border:1px solid #e2e8f0;">
                </a>
                <p style="font-size:13px; font-weight:600; margin-top:8px; text-align:center;">{{ $item->name }}</p>
            </div>
            @empty
            <div class="col-12 text-center py-5"><p>No images in this category.</p></div>
            @endforelse
        </div>
        <div class="pagination-wrapper" style="margin-top:28px; padding:16px; background:#fff; border-radius:14px; border:1px solid #e2e8f0; display:flex; flex-direction:column; align-items:center; gap:10px;">
            <div style="display:flex; gap:8px;">
                @if($items->onFirstPage())
                    <span style="padding:8px 16px; background:#f1f5f9; color:#94a3b8; border-radius:999px; font-size:12px; font-weight:600; border:1px solid #e2e8f0;">← Previous</span>
                @else
                    <a href="{{ $items->previousPageUrl() }}" style="padding:8px 16px; background:#0f172a; color:#fff; border-radius:999px; font-size:12px; font-weight:600; text-decoration:none;">← Previous</a>
                @endif
                @if($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}" style="padding:8px 16px; background:#0f172a; color:#fff; border-radius:999px; font-size:12px; font-weight:600; text-decoration:none;">Next →</a>
                @else
                    <span style="padding:8px 16px; background:#f1f5f9; color:#94a3b8; border-radius:999px; font-size:12px; font-weight:600; border:1px solid #e2e8f0;">Next →</span>
                @endif
            </div>
            <small style="color:#64748b; font-size:12px;">Page {{ $items->currentPage() }} of {{ $items->lastPage() }} • {{ $items->total() }} images</small>
        </div>
    </div>
</section>
</div>
@endsection
@push('scripts')
    @include('frontend.image.include.js')
@endpush
<style>
@media(max-width:576px){
  .image-gallery-grid{grid-template-columns:repeat(2,1fr) !important; gap:10px !important;}
  .gallery-area .container{width:100% !important; max-width:100% !important; padding-left:10px !important; padding-right:10px !important;}
}
</style>
