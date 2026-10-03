@extends('layouts.frontend')
@section('title','Our Activities')
@section('content')
<style>
.activities-hero{background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #0d1b3e 100%); color:#fff; padding:70px 0 60px; text-align:center; position:relative; overflow:hidden;}
.activities-hero::after{content:''; position:absolute; bottom:-1px; left:0; right:0; height:40px; background:#fff; border-radius:40px 40px 0 0;}
.activities-hero h1{font-family:var(--font-display,'Playfair Display',serif); font-size:clamp(32px,5vw,48px); font-weight:800; margin:0 0 10px;}
.activities-hero p{color:rgba(255,255,255,0.75); max-width:600px; margin:0 auto; font-size:16px;}
.activities-wrap{padding:50px 0 70px; background:#fff;}
.activity-card{border:1px solid #e2e8f0; border-radius:20px; overflow:hidden; background:#fff; transition:all .3s; height:100%; display:flex; flex-direction:column;}
.activity-card:hover{transform:translateY(-4px); box-shadow:0 12px 30px rgba(15,23,42,0.08); border-color:#cbd5e1;}
.activity-card img{width:100%; height:200px; object-fit:cover;}
.activity-card .card-body{padding:18px; flex:1; display:flex; flex-direction:column;}
.activity-card h3{font-size:17px; font-weight:700; color:#0f172a; margin:0 0 8px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;}
.activity-card p{color:#64748b; font-size:14px; line-height:1.6; flex:1; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;}
.activity-card .card-foot{margin-top:14px; display:flex; justify-content:space-between; align-items:center;}
.activity-card .read-more{color:#c9962a; font-weight:600; font-size:13px; text-decoration:none;}
.activity-card .read-more:hover{color:#b0811e;}
@media(max-width:576px){ .activities-hero{padding:50px 0 40px;} .activity-card img{height:180px;} }
</style>

<section class="activities-hero">
    <div class="container">
        <h1>Our Activities</h1>
        <p>Discover the initiatives we run for education, welfare and community development.</p>
    </div>
</section>

<section class="activities-wrap">
    <div class="container">
        @if($activities->count())
        <div class="row g-4">
            @foreach($activities as $act)
            <div class="col-md-6 col-lg-4">
                <a href="{{ route('activities.show',$act->slug) }}" class="text-decoration-none">
                    <div class="activity-card">
                        @if($act->image)
                            <img src="{{ asset('storage/'.$act->image) }}" alt="{{ $act->title }}">
                        @else
                            <div style="height:200px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#94a3b8;"><i class="fas fa-image fa-2x"></i></div>
                        @endif
                        <div class="card-body">
                            <h3>{{ $act->title }}</h3>
                            <p>{{ $act->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($act->description), 120) }}</p>
                            <div class="card-foot">
                                <span class="read-more">View Details <i class="fas fa-arrow-right ms-1"></i></span>
                                <small class="text-muted">{{ $act->created_at->format('d M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">{{ $activities->links('pagination::bootstrap-5') }}</div>
        @else
        <div class="text-center py-5"><p class="text-muted">No activities published yet.</p></div>
        @endif
    </div>
</section>
@endsection
