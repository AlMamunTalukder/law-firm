@extends('layouts.frontend')

@section('title', 'All Notices')

@section('content')
<section class="single-page-main-area notice-list-section">
    <div class="container">
        <div class="section-heading" data-aos="fade-down">
            <h3 class="text-center">All Notices</h3>
            <p class="sub-title text-center">Law Firm</p>
        </div>

        <div class="row g-4">
            @forelse($notices as $notice)
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <article class="notice-card">
                        @if($notice->photo)
                            <div class="notice-card__image-wrap">
                                <img src="{{ asset('storage/'.$notice->photo) }}" class="notice-card__image" alt="{{ $notice->title }}">
                            </div>
                        @endif
                        <div class="notice-card__body">
                            <div class="notice-card__meta">
                                <span class="notice-card__badge">Notice</span>
                                <span class="notice-card__date">{{ optional($notice->created_at)->format('d M, Y') }}</span>
                            </div>
                            <h5 class="notice-card__title">{{ $notice->title }}</h5>
                            <p class="notice-card__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($notice->content), 140) }}</p>
                            <a href="{{ route('notices.show', $notice->slug) }}" class="notice-card__link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No notices available yet.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $notices->links() }}
        </div>
    </div>
</section>

<style>
    .notice-list-section {
        padding: 60px 0;
        background: #f8fafc;
    }

    .notice-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        height: 100%;
        border: 1px solid #eef2f7;
    }

    .notice-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.12);
    }

    .notice-card__image-wrap {
        overflow: hidden;
        height: 220px;
    }

    .notice-card__image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .notice-card__body {
        padding: 22px;
    }

    .notice-card__meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
    }

    .notice-card__badge {
        background: #eef5ff;
        color: #1d4ed8;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 0.35rem 0.7rem;
        border-radius: 999px;
    }

    .notice-card__date {
        color: #64748b;
        font-size: 0.88rem;
    }

    .notice-card__title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .notice-card__excerpt {
        color: #475569;
        font-size: 0.95rem;
        line-height: 1.65;
        margin-bottom: 16px;
    }

    .notice-card__link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        color: #0f6fff;
        text-decoration: none;
    }

    .notice-card__link:hover {
        color: #0a4ec5;
    }
</style>
@endsection
