@extends('layouts.frontend')
@section('title') {{ $category->name ?? 'Videos' }} @endsection
@section('content')
<div class="content">
<section class="youtube-gallery-area" style="padding:40px 0;">
    <div class="container">
        <div class="section-heading text-center" data-aos="fade-down">
            <h3>{{ $category->name }}</h3>
            <a href="{{ route('video') }}" style="font-size:13px; color:#64748b; text-decoration:none;">← Back to Videos</a>
        </div>
        <div class="youtube-grid" style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:16px;">
            @forelse($items as $item)
            <div class="yt-video-card" style="background:#fff; border-radius:14px; overflow:hidden; border:1px solid #e2e8f0;">
                <div class="yt-thumbnail" style="position:relative; height:180px; overflow:hidden;">
                    <a class="video" title="{{ $item->name }}" href="{{ $item->link ?? '#' }}" target="_blank">
                        @if($item->photo)
                            <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            <img src="https://img.youtube.com/vi/{{ parse_youtube_video_url_for_image($item->link ?? '') }}/sddefault.jpg" alt="{{ $item->name }}" style="width:100%; height:100%; object-fit:cover;">
                        @endif
                        <span class="yt-play-button" style="position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); background:rgba(0,0,0,0.6); color:#fff; width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="fas fa-play"></i></span>
                    </a>
                </div>
                <div class="yt-video-info" style="padding:12px;">
                    <div class="yt-video-title" style="font-weight:700; font-size:14px; color:#0f172a; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->name }}</div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5"><p>No videos in this category.</p></div>
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
            <small style="color:#64748b; font-size:12px;">Page {{ $items->currentPage() }} of {{ $items->lastPage() }} • {{ $items->total() }} videos</small>
        </div>
    </div>
</section>
</div>
@endsection
@push('scripts')
    @include('frontend.video.include.js')
@endpush
<style>
@media(max-width:576px){
  .youtube-grid{grid-template-columns:repeat(2,1fr) !important; gap:10px !important;}
  .youtube-gallery-area .container{width:100% !important; max-width:100% !important; padding-left:10px !important; padding-right:10px !important;}
}
</style>
