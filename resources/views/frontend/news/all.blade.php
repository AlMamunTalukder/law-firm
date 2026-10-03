@extends('layouts.frontend')
@section('title') {{ $category->name ?? 'All News' }} @endsection
@section('meta')
<meta name="author" content="{{ $category->meta_title ?? '' }}">
<meta name="keywords" content="{{ $category->meta_keyword ?? '' }}">
<meta name="description" content="{{ $category->meta_description ?? '' }}">
@endsection
@section('content')
<div class="content">
    <section class="news-section-area">
        <div class="container">
            <div class="news-header" data-aos="fade-down">
                <div class="header-title-box">
                    <h3>{{ $category->name }} - All</h3>
                    <div class="news-title-line"></div>
                </div>
                <a href="{{ route('news', $category->slug) }}" class="btn-see-all">Back <i class='bx bx-left-arrow-alt'></i></a>
            </div>
            <div class="news-row">
                @forelse($items as $item)
                    <article class="news-card-editorial" data-aos="fade-up" onclick="window.location='{{ route('news.details', $item->slug) }}'">
                        <div class="news-thumb">
                            <img src="{{ asset('storage/'.($item->photo ?? '')) }}" alt="{{ $item->name }}">
                        </div>
                        <div class="news-content">
                            <h4 class="bn">{{ Str::limit($item->name, 48) }}</h4>
                            <p>{!! Str::limit(strip_tags($item->description ?? ''), 85) !!}</p>
                            <div class="news-card-footer">
                                <span class="read-link">Read More <i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-12 text-center py-5"><h4>No news found.</h4></div>
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
                <small style="color:#64748b; font-size:12px;">Page {{ $items->currentPage() }} of {{ $items->lastPage() }} • {{ $items->total() }} news</small>
            </div>
        </div>
    </section>
</div>
@endsection
