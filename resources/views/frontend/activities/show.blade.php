@extends('layouts.frontend')
@section('title', $activity->title)
@section('content')
<style>
.detail-hero{height:420px; position:relative; overflow:hidden; background:#0f172a;}
.detail-hero img{width:100%; height:100%; object-fit:cover;}
.detail-hero .overlay{position:absolute; inset:0; background:linear-gradient(to top, rgba(7,13,32,0.85) 0%, rgba(7,13,32,0.35) 45%, transparent 75%);}
.detail-hero .hero-inner{position:absolute; inset:0; display:flex; align-items:flex-end; padding:0 0 36px;}
.detail-hero h1{font-family:var(--font-display,'Playfair Display',serif); font-size:clamp(26px,4.2vw,42px); font-weight:800; color:#fff; line-height:1.15; margin:0 0 8px; text-shadow:0 2px 12px rgba(0,0,0,0.25);}
.detail-hero .meta{display:flex; flex-wrap:wrap; gap:10px; align-items:center; color:rgba(255,255,255,0.85); font-size:13px;}
.detail-hero .meta .badge{backdrop-filter:blur(6px); background:rgba(255,255,255,0.14); border:1px solid rgba(255,255,255,0.18); border-radius:20px; padding:6px 10px; font-size:12px;}
.breadcrumb-wrap{padding:14px 0; background:#f8fafc; border-bottom:1px solid #e2e8f0; font-size:13px;}
.breadcrumb-wrap a{color:#64748b; text-decoration:none;}
.breadcrumb-wrap a:hover{color:#c9962a;}
.activity-layout{padding:32px 0 60px; background:#fff;}
.content-wrap{max-width:780px;}
.rich-content{color:#334155; line-height:1.85; font-size:16px;}
.rich-content p{margin:0 0 14px;}
.rich-content h2,.rich-content h3{font-family:var(--font-display,'Playfair Display',serif); color:#0f172a; font-weight:700; margin:22px 0 10px; line-height:1.3;}
.rich-content h2{font-size:24px;} .rich-content h3{font-size:20px;}
.rich-content .ql-align-center{text-align:center;}
.rich-content .ql-align-right{text-align:right;}
.rich-content .ql-align-justify{text-align:justify;}
.rich-content table{border-collapse:collapse; width:100%; margin:16px 0; font-size:14px; display:block; overflow-x:auto; -webkit-overflow-scrolling:touch;}
.rich-content th,.rich-content td{border:1px solid #e2e8f0; padding:9px 12px; text-align:left;}
.rich-content th{background:#f8fafc; font-weight:600; color:#0f172a;}
.rich-content img{max-width:100%; height:auto; border-radius:10px; margin:10px 0;}
.rich-content blockquote{border-left:4px solid #c9962a; margin:18px 0; padding:14px 18px; background:#faf6ef; color:#475569; border-radius:0 10px 10px 0; font-style:italic;}
.rich-content a{color:#c9962a; text-decoration:underline; text-underline-offset:2px;}
.sidebar-card{border:1px solid #e2e8f0; border-radius:16px; padding:18px; background:#fff; position:sticky; top:84px;}
.sidebar-card h4{font-size:14px; font-weight:700; color:#0f172a; margin:0 0 12px; display:flex; align-items:center; gap:8px;}
.sidebar-card h4 i{color:#c9962a;}
.related-card{border:1px solid #eef2f7; border-radius:16px; overflow:hidden; background:#fff; transition:all .25s; height:100%;}
.related-card:hover{transform:translateY(-3px); box-shadow:0 10px 24px rgba(15,23,42,0.08); border-color:#e2e8f0;}
.related-card img{height:150px; object-fit:cover; width:100%;}
@media(max-width:768px){
  .detail-hero{height:300px;}
  .detail-hero .hero-inner{padding-bottom:22px;}
  .activity-layout{padding:22px 0 40px;}
  .rich-content{font-size:15px;}
  .sidebar-card{position:static; margin-top:22px;}
}
</style>

<div class="detail-hero">
    @if($activity->image)
        <img src="{{ asset('storage/'.$activity->image) }}" alt="{{ $activity->title }}">
    @else
        <div style="height:100%; background:linear-gradient(135deg,#0f172a 0%,#1e3a5f 60%,#c9962a 100%);"></div>
    @endif
    <div class="overlay"></div>
    <div class="hero-inner">
        <div class="container">
            <h1>{{ $activity->title }}</h1>
            <div class="meta">
                <span><i class="far fa-calendar me-1"></i> {{ $activity->created_at->format('d M Y') }}</span>
                <span class="badge">Activity</span>
                <a href="{{ route('contact') }}" style="color:#ffd76d; font-weight:600; text-decoration:none;">Contact Us <i class="fas fa-envelope ms-1" style="font-size:11px;"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="breadcrumb-wrap">
    <div class="container" style="max-width:780px;">
        <a href="{{ route('home') }}">Home</a> <span style="color:#cbd5e1; margin:0 6px;">/</span>
        <a href="{{ route('activities.index') }}">Our Activities</a> <span style="color:#cbd5e1; margin:0 6px;">/</span>
        <span style="color:#0f172a; font-weight:500;">{{ \Illuminate\Support\Str::limit($activity->title, 40) }}</span>
    </div>
</div>

<section class="activity-layout">
    <div class="container" style="max-width:1100px;">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="content-wrap">
                    @if($activity->excerpt)
                        <div style="background:#f8fafc; border-left:4px solid #c9962a; padding:14px 16px; border-radius:0 12px 12px 0; color:#334155; font-size:16px; line-height:1.7; margin-bottom:20px;">
                            {{ $activity->excerpt }}
                        </div>
                    @endif

                    <div class="rich-content">{!! $activity->description !!}</div>

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary" style="border-radius:10px; padding:10px 18px;"><i class="fas fa-arrow-left me-1"></i> All Activities</a>
                        <a href="{{ route('contact') }}" class="btn" style="background:#0f172a; color:#fff; border-radius:10px; padding:10px 20px; font-weight:600;">Contact Us <i class="fas fa-envelope ms-1" style="color:#ffd76d;"></i></a>
                        <button onclick="if(navigator.share){navigator.share({title:document.title, url:location.href})}else{navigator.clipboard.writeText(location.href); alert('Link copied!')}" class="btn btn-light" style="border:1px solid #e2e8f0; border-radius:10px;"><i class="fas fa-share-nodes me-1"></i> Share</button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sidebar-card">
                    <h4><i class="fas fa-info-circle"></i> About this activity</h4>
                    <p class="small text-muted mb-3" style="line-height:1.6;">{{ $activity->excerpt ? \Illuminate\Support\Str::limit($activity->excerpt, 140) : 'Learn more about this initiative and how you can support it.' }}</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('contact') }}" class="btn" style="background:#c9962a; color:#fff; font-weight:700; border-radius:10px; padding:11px;">Ask about this matter</a>
                        <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary" style="border-radius:10px;">Browse all activities</a>
                    </div>
                    <hr class="my-3" style="border-color:#e2e8f0;">
                    <div class="d-flex align-items-center gap-2 small text-muted">
                        <i class="far fa-clock"></i> Published {{ $activity->created_at->diffForHumans() }}
                    </div>
                </div>

                @if($related->count())
                <div class="sidebar-card mt-3">
                    <h4><i class="fas fa-layer-group"></i> More Activities</h4>
                    <div class="d-flex flex-column gap-3">
                        @foreach($related as $r)
                        <a href="{{ route('activities.show',$r->slug) }}" class="text-decoration-none">
                            <div class="d-flex gap-3 align-items-center">
                                @if($r->image)
                                    <img src="{{ asset('storage/'.$r->image) }}" alt="{{ $r->title }}" style="width:64px; height:64px; object-fit:cover; border-radius:10px; flex-shrink:0;">
                                @else
                                    <div style="width:64px; height:64px; background:#f1f5f9; border-radius:10px; flex-shrink:0;"></div>
                                @endif
                                <div style="font-size:13px; font-weight:600; color:#0f172a; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $r->title }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($related->count())
        <hr class="my-5">
        <h4 style="font-weight:800; color:#0f172a; font-family:var(--font-display,'Playfair Display',serif);">You may also like</h4>
        <div class="row g-3 mt-1">
            @foreach($related->take(4) as $r)
            <div class="col-6 col-md-3">
                <a href="{{ route('activities.show',$r->slug) }}" class="text-decoration-none">
                    <div class="related-card">
                        @if($r->image)<img src="{{ asset('storage/'.$r->image) }}" alt="{{ $r->title }}">@else<div style="height:150px; background:#f1f5f9;"></div>@endif
                        <div style="padding:12px;"><div style="font-size:13px; font-weight:600; color:#0f172a; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $r->title }}</div><small class="text-muted">{{ $r->created_at->format('d M Y') }}</small></div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection
