@extends('layouts.frontend')

@section('title')
{{ $item->name ?? __('page.Home') }}
@endsection

@section('content')
@if($item->photo)
<div class="container">
    <div class="magazine-image-viewport" data-aos="fade-up">
        <div class="viewport-overlay"></div>
        <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->name }}">

    </div>
</div>
@endif

<section class="single-page-main-area">
    <div class="container">
        <div class="single-page-wrapper">
            <div class="left-side-content" data-aos="fade-right">
                <h2 data-aos="fade-down">{{ $item->name }}</h2>
                <div class="news-meta-row">
                    <span>{{ optional($item->created_at)->format('d M, Y') }}</span>
                    @if(!empty($item->writer))
                        <span>{{ $item->writer->name ?? 'Admin' }}</span>
                    @endif
                    <span>{{ $item->total_visit ?? 0 }} Views</span>
                </div>
                <div class="news-description rich-content" style="color:#334155; line-height:1.75; font-size:15px;">{!! $item->description !!}</div>
                <style>.rich-content .ql-align-center{text-align:center;}.rich-content .ql-align-right{text-align:right;}.rich-content .ql-align-justify{text-align:justify;}.rich-content table{border-collapse:collapse; width:100%; margin:12px 0;} .rich-content td,.rich-content th{border:1px solid #cbd5e1; padding:8px;} .rich-content img{max-width:100%; height:auto; border-radius:8px;} .rich-content blockquote{border-left:4px solid #c9962a; margin:12px 0; padding:8px 16px; color:#475569;}</style>
            </div>
            <div class="right-side-branch-list" data-aos="fade-left">
                <h4><i class='bx bx-notepad'></i> Other News</h4>
                <ul>
                    @foreach($relatedNews as $news)
                        <li>
                            <a href="{{ route('news.details', $news->slug) }}">
                                <i class='bx bx-chevron-right'></i> {{ $news->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                @if($hasMoreRelatedNews)
                    <a href="{{ route('news') }}" class="see-more-news-btn">See More News</a>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
@endpush
