@extends('layouts.frontend')

@section('title')
    {{ $category->name ?? 'News' }}
@endsection

@section('meta')
    <meta name="author" content="{{ $category->meta_title ?? '' }}">
    <meta name="keywords" content="{{ $category->meta_keyword ?? '' }}">
    <meta name="description" content="{{ $category->meta_description ?? '' }}">
@endsection

@section('content')
<div class="content">

    <section class="top-add">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-add-item">
                        @php $adv = get_ads($ads,'news_category_top_horizontal'); @endphp
                        <a href="{{($adv->link??'')}}"><img class="lazy" src="{{asset('storage/'.($adv->photo??''))}}" alt="" data-aos="fade-up" data-aos-duration="3000"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-section-area">
        <div class="container">
            <div class="news-header" data-aos="fade-down">
                <div class="header-title-box">
                    <h3>{{ $category->name }}</h3>
                    <div class="news-title-line"></div>
                </div>

            </div>

            <div class="news-row">
                @forelse($items as $item)
                    <a href="{{ route('news.details', $item->slug) }}" class="news-card-editorial" data-aos="fade-up" style="text-decoration:none; color:inherit; display:flex; flex-direction:column;">
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
                    </a>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4>No news found in this category.</h4>
                    </div>
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

@push('styles')
<style>

    .news-section-area {
        padding: 60px 0;
        background: #f8fafc;
    }
    .news-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .header-title-box {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .news-tagline {
        background: #e74c3c;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .news-title-line {
        width: 40px;
        height: 3px;
        background: #e74c3c;
        border-radius: 2px;
    }
    .btn-see-all {
        background: transparent;
        border: 1px solid #ddd;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        transition: 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-see-all:hover {
        background: #e74c3c;
        color: #fff;
        border-color: #e74c3c;
    }
    .news-row {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
    .news-card-editorial {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: 0.3s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }
    .news-card-editorial:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    .news-thumb {
        position: relative;
        padding-top: 65%;
        background: #f0f0f0;
    }
    .news-thumb img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .news-date-badge {
        position: absolute;
        bottom: 12px;
        left: 12px;
        background: rgba(0,0,0,0.7);
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        backdrop-filter: blur(2px);
    }
    .news-content {
        padding: 18px 20px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .news-content h4 {
        font-size: 1.05rem;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.3;
        color: #1a202c;
    }
    .news-content p {
        font-size: 0.92rem;
        color: #4a5568;
        line-height: 1.5;
        flex: 1;
        margin-bottom: 12px;
    }
    .news-card-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: auto;
    }
    .read-link {
        font-size: 0.85rem;
        font-weight: 600;
        color: #e74c3c;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: 0.2s;
    }
    .read-link i {
        transition: 0.2s;
    }
    .news-card-editorial:hover .read-link i {
        transform: translateX(4px);
    }

    @media (max-width: 768px) {
        .news-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .news-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
