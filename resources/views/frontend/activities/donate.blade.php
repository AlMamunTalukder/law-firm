@extends('layouts.frontend')
@section('title', 'Donate Us')
@section('content')
    <style>
        .donate-hero {
            background: linear-gradient(135deg, #0d1b3e 0%, #1e3a5f 70%, #c9962a 100%);
            color: #fff;
            padding: 36px 0 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .donate-hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 24px;
            background: #fff;
            border-radius: 24px 24px 0 0;
        }

        .donate-hero h1 {
            font-family: var(--font-display, 'Playfair Display', serif);
            font-size: clamp(24px, 4vw, 36px);
            font-weight: 800;
            margin: 0 0 8px;
            line-height:1.2;
        }

        .donate-hero p {
            color: rgba(255, 255, 255, 0.85);
            max-width: 640px;
            margin: 0 auto;
            font-size:14px;
            line-height:1.5;
        }

        .donate-portrait-hero {
            position: relative;
            width: 100%;
            min-height: 300px;
            height: clamp(300px, 50vh, 520px);
            background: #0a0f1e;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .donate-portrait-hero img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center center;
        }

        .donate-portrait-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(5, 10, 28, 0.18) 0%, rgba(5, 10, 28, 0.45) 45%, rgba(5, 10, 28, 0.78) 100%);
            z-index: 1;
        }

        .donate-portrait-hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 36px;
            background: #fff;
            border-radius: 36px 36px 0 0;
            z-index: 2;
        }

        .donate-portrait-hero .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            color: #fff;
            padding: 40px 20px;
            max-width: 960px;
            margin: 0 auto;
        }

        .donate-portrait-hero .hero-title-big {
            font-family: var(--font-display, 'Playfair Display', serif);
            font-size: clamp(36px, 7vw, 72px);
            font-weight: 800;
            line-height: 1.05;
            margin: 0 0 16px;
            text-shadow: 0 4px 24px rgba(0, 0, 0, 0.55), 0 1px 2px rgba(0, 0, 0, 0.4);
        }

        .donate-portrait-hero .hero-subtitle {
            font-size: clamp(15px, 2.2vw, 19px);
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.92);
            max-width: 680px;
            margin: 0 auto;
            text-shadow: 0 2px 12px rgba(0, 0, 0, 0.45);
        }

        .donate-portrait-hero .hero-cta {
            margin-top: 22px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #c9962a;
            color: #0f172a;
            font-weight: 700;
            padding: 12px 26px;
            border-radius: 999px;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            transition: .2s;
        }

        .donate-portrait-hero .hero-cta:hover {
            background: #e0ad3a;
            transform: translateY(-1px);
        }

        .donate-wrap {
            padding: 50px 0 70px;
            background: #fff;
        }

        @media(max-width:576px) {
            .donate-hero {
                padding: 24px 0 20px;
            }
            .donate-hero::after{height:16px; border-radius:16px 16px 0 0;}
            .donate-hero h1{font-size:22px; margin-bottom:6px;}
            .donate-hero p{font-size:12px;}

            .donate-portrait-hero {
                height: clamp(280px, 50vh, 420px);
                min-height: 280px;
            }
        }

        .donate-qr-center {
            max-width: 440px;
            margin: 0 auto 36px;
        }

        .qr-box {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 28px;
            text-align: center;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .qr-box.qr-centered {
            padding: 20px 15px;
            border-radius: 22px;
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.08);
        }

        .qr-box img {
            width: 100%;
            border-radius: 12px;
            display: block;
            margin: 0 auto;
        }

        .donate-banks-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .donate-banks-title h4 {
            font-weight: 800;
            color: #0f172a;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            margin: 0;
        }

        .donate-banks-title h4 i {
            color: #c9962a;
        }

        .bank-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px;
            background: #f8fafc;
            height: 100%;
            transition: .2s;
        }

        .bank-card:hover {
            border-color: #cbd5e1;
            background: #fff;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        }

        .bank-card .bank-name {
            font-weight: 700;
            color: #0f172a;
            font-size: 15px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bank-card .bank-name i {
            color: #c9962a;
        }

        .bank-card .kv {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            padding: 6px 0;
            border-bottom: 1px dashed #e2e8f0;
        }

        .bank-card .kv:last-child {
            border: none;
        }

        .bank-card .k {
            color: #64748b;
        }

        .bank-card .v {
            font-weight: 600;
            color: #0f172a;
            font-family: monospace;
            word-break: break-all;
            text-align: right;
            margin-left: 10px;
        }

        .activity-mini {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 14px 16px;
            background: #fff;
            transition: .2s;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .activity-mini:hover {
            border-color: #c9962a;
            background: #faf6ef;
            transform: translateY(-2px);
        }

        .activity-mini .name {
            font-weight: 600;
            color: #0f172a;
            font-size: 14px;
        }

        .rich-content .ql-align-center {
            text-align: center;
        }

        .rich-content .ql-align-right {
            text-align: right;
        }

        .rich-content table {
            border-collapse: collapse;
            width: 100%;
        }

        .rich-content td,
        .rich-content th {
            border: 1px solid #e2e8f0;
            padding: 8px;
        }

        .rich-content img {
            max-width: 100%;
        }

        @media(max-width:576px) {
            .donate-hero 
            { padding: 24px 0 20px; }
            .donate-hero::after{height:16px; border-radius:16px 16px 0 0;}
            .donate-hero h1{font-size:22px; margin-bottom:6px;}
            .donate-hero p{font-size:12px;}
            .donate-portrait-hero .hero-content{padding:24px 16px;}
            .donate-portrait-hero .hero-title-big{font-size:30px; margin-bottom:10px;}
            .donate-portrait-hero .hero-subtitle{font-size:13px;}
            .donate-portrait-hero .hero-cta{padding:10px 20px; font-size:13px; margin-top:16px;}
            .donate-wrap{padding:0px 0 36px;}
            .donate-wrap .rich-content{font-size:14px; line-height:1.6;}
            .donate-qr-center{margin-bottom:20px; max-width:340px;}
            .qr-box.qr-centered{padding:16px; border-radius:18px;}
            .qr-box h5{font-size:15px !important; margin-bottom:10px !important;}
            .qr-box img{max-width:220px;}
            .donate-banks{margin-bottom:24px !important;}
            .donate-banks-title{margin-bottom:12px;}
            .donate-banks-title h4{font-size:15px;}
            .bank-card{padding:12px; border-radius:12px;}
            .bank-card .bank-name{font-size:13px;}
            .bank-card .kv{font-size:11px; padding:4px 0;}
            .bank-card .btn{font-size:12px; padding:6px;}
            hr.my-5{margin:1.5rem 0 !important;}
            .activity-mini{padding:10px 12px; border-radius:10px;}
            .activity-mini .name{font-size:12px;}
        }
    </style>

    @if(!empty($donate->hero_image))
        <section class="donate-portrait-hero">
            <img src="{{ asset('storage/' . $donate->hero_image) }}"
                alt="{{ $donate->hero_title ?? $donate->title ?? 'Donate Us' }}" loading="eager">
            <div class="hero-content">
                <h1 class="hero-title-big">{{ $donate->hero_title ?? $donate->title ?? 'Donate Us' }}</h1>
                @if(!empty($donate->hero_subtitle))
                    <p class="hero-subtitle">{{ $donate->hero_subtitle }}</p>
                @else
                    <p class="hero-subtitle">
                        {{ strip_tags($donate->description ?? '') ? \Illuminate\Support\Str::limit(strip_tags($donate->description), 120) : 'Your generosity powers our work.' }}
                    </p>
                @endif
                <a href="#donate-details" class="hero-cta"><i class="fas fa-heart"></i> Donate Now</a>
            </div>
        </section>
    @else
        <section class="donate-hero">
            <div class="container">
                <h1>{{ $donate->title ?? 'Donate Us' }}</h1>
                <p>{{ strip_tags($donate->description ?? '') ? \Illuminate\Support\Str::limit(strip_tags($donate->description), 160) : 'Your generosity powers our work.' }}
                </p>
            </div>
        </section>
    @endif

    <section class="donate-wrap" id="donate-details">
        <div class="container">
            @if(!empty($donate->description))
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-9">
                        <div class="rich-content text-center" style="color:#334155; line-height:1.8; text-align:center;">
                            {!! $donate->description !!}</div>
                    </div>
                </div>
            @endif

            <div class="donate-qr-center">
                <div class="qr-box qr-centered">
                    <h5 style="font-weight:700; color:#0f172a; margin-bottom:14px;"><i class="fas fa-qrcode me-2"
                            style="color:#c9962a;"></i> Scan to Donate</h5>
                    @if(!empty($donate->qr_image))
                        <img src="{{ asset('storage/' . $donate->qr_image) }}" alt="QR Code">
                    @else
                        <div
                            style="height:200px; background:#f1f5f9; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                            QR not set yet</div>
                    @endif
                </div>
            </div>

            <div class="donate-banks mb-5">
                <div class="donate-banks-title">
                    <h4><i class="fas fa-university"></i> Bank Details</h4>
                </div>
                @if($banks->count())
                    <div class="row g-3 g-md-4 justify-content-center">
                        @foreach($banks as $b)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="bank-card">
                                    <div class="bank-name"><i class="fas fa-landmark"></i> {{ $b->bank_name }}</div>
                                    @if($b->account_name)
                                        <div class="kv"><span class="k">Account Name</span><span class="v">{{ $b->account_name }}</span>
                                    </div>@endif
                                    <div class="kv"><span class="k">Account No</span><span class="v">{{ $b->account_no }}</span>
                                    </div>
                                    @if($b->branch)
                                    <div class="kv"><span class="k">Branch</span><span class="v">{{ $b->branch }}</span></div>@endif
                                    @if($b->routing_no)
                                        <div class="kv"><span class="k">Routing</span><span class="v">{{ $b->routing_no }}</span></div>
                                    @endif
                                    <button
                                        onclick="navigator.clipboard.writeText('{{ $b->account_no }}'); this.textContent='Copied!'; setTimeout(()=>this.textContent='Copy Account No',1500)"
                                        class="btn btn-sm btn-outline-secondary w-100 mt-3">Copy Account No</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light border text-center">Bank details will appear here.</div>
                @endif
            </div>

            <hr class="my-5">
            <div class="text-center mb-4">
                <h3 style="font-family:var(--font-display,'Playfair Display',serif); font-weight:800; color:#0f172a;">
                    Support an Activity</h3>
                <p class="text-muted">Choose an activity to learn more and donate directly.</p>
            </div>
            @if($activities->count())
                <div class="row g-3">
                    @foreach($activities as $act)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('activities.show', $act->slug) }}" class="text-decoration-none">
                                <div class="activity-mini">
                                    <span class="name">{{ $act->title }}</span>
                                    <i class="fas fa-arrow-right" style="color:#c9962a; font-size:12px;"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted">Activities will appear here once published.</p>
            @endif
        </div>
    </section>
@endsection