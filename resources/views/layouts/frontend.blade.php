<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $settings->title }}</title>

    @yield('extracss')
    @stack('styles')

    <link href="{{ asset('storage/'.$settings->favicon) }}" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('front_assets/css/fonts/custom-font.css') }}">

    <link href="{{ asset('front_assets/css/boxicons/css/boxicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('front_assets/lightbox/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front_assets/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front_assets/swiper@11/swiper-bundle.min.css') }}" />

    <link href="{{ asset('front_assets/css/aos.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('front_assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/socialmedia.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/explorebranches.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/branches.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/impact.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/projectshowcase.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/video.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/location.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/team.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/connect.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/aboutnotice.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/gallery.css') }}">
    <link rel="stylesheet" href="{{ asset('front_assets/css/chamber.css') }}">

    @hasSection('meta')
    @yield('meta')
    @else
    <meta name="author" content="{{$settings->meta_title}}">
    <meta name="keywords" content="{{$settings->meta_keyword}}">
    <meta name="description" content="{{$settings->meta_description}}">
    @endif

    <script src="{{ asset('front_assets/js/home.js') }}"></script>
    <script src="{{ asset('front_assets/js/main.js') }}"></script>
</head>

<body>
    <header class="ch-header"> 
        <div class="container d-flex align-items-center gap-3 py-3">
            <a href="{{ route('home') }}" class="ch-brand d-flex align-items-center gap-3 text-decoration-none flex-shrink-0" aria-label="Homepage">
                <span class="ch-monogram" aria-hidden="true">
                    <svg viewBox="0 0 52 58" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="square">
                        <path d="M8 10 V48 M8 10 H44 M8 18 H30 M14 18 V48 M26 18 V48 M26 18 L40 48 M40 28 V48 M40 28 H48 M48 28 V48" />
                    </svg>
                    @if(!empty($settings->logo))
                    <img src="{{ asset('storage/'.$settings->logo) }}" alt="" onerror="this.remove()">
                    @endif
                </span>
                <span class="ch-brand-text lh-sm">
                    <span class="ch-brand-name d-block">{{ $settings->name ?? 'N.H. TALUKDER & ASSOCIATES' }}</span>
                    <span class="ch-brand-estd d-block">ESTD. 2024</span>
                </span>
            </a>
            <nav class="ch-nav d-none d-lg-flex align-items-center gap-4 ms-auto" aria-label="Primary">
                <a href="{{ route('home') }}" class="text-decoration-none {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('all.details', ['info','about']) }}" class="text-decoration-none">About</a>
                <div class="ch-nav-drop">
                    <button type="button">Practice Areas <span class="chev">▾</span></button>
                    <ul class="ch-drop-menu">
                        {{-- TODO(dynamic): render from practice-areas table when available --}}
                        <li><a href="{{ route('all.details', ['info','about']) }}">Civil &amp; Criminal Litigation</a></li>
                        <li><a href="{{ route('all.details', ['info','about']) }}">Corporate &amp; Commercial Law</a></li>
                        <li><a href="{{ route('all.details', ['info','about']) }}">Family &amp; Property Law</a></li>
                        <li><a href="{{ route('all.details', ['info','about']) }}">Legal Advisory Services</a></li>
                    </ul>
                </div>
                <a href="{{ route('teachers.index') }}" class="text-decoration-none">Our Team</a>
                <div class="ch-nav-drop">
                    <button type="button">Insights <span class="chev">▾</span></button>
                    <ul class="ch-drop-menu">
                        <li><a href="{{ route('news', 'News') }}">Legal Insights</a></li>
                        <li><a href="{{ route('notices.index') }}">Notices</a></li>
                    </ul>
                </div>
                <a href="{{ route('contact') }}" class="text-decoration-none {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </nav>
            <a href="{{ route('contact') }}" class="btn ch-consult-btn d-none d-lg-inline-flex align-items-center rounded-1 text-nowrap ms-lg-3">Book a Consultation <span class="arr">→</span></a>
            <button type="button" id="open-menu-btn" class="btn ch-burger d-lg-none ms-auto">
                <span>Menu</span>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M3 18H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </header>
    <div id="menu-box" class="ch-menu">
        <div class="menu-header">
            <button type="button" id="close-menu-btn">
                <span>Close</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('all.details', ['info','about']) }}">About</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="has-arrow dropdown-toggle">
                        <span>Practice Areas</span>
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        {{-- TODO(dynamic): render from practice-areas table when available --}}
                        <li><a href="{{ route('all.details', ['info','about']) }}">Civil &amp; Criminal Litigation</a></li>
                        <li><a href="{{ route('all.details', ['info','about']) }}">Corporate &amp; Commercial Law</a></li>
                        <li><a href="{{ route('all.details', ['info','about']) }}">Family &amp; Property Law</a></li>
                        <li><a href="{{ route('all.details', ['info','about']) }}">Legal Advisory Services</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('teachers.index') }}">Our Team</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="has-arrow dropdown-toggle">
                        <span>Insights</span>
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('news', 'News') }}">Legal Insights</a></li>
                        <li><a href="{{ route('notices.index') }}">Notices</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
            <a href="{{ route('contact') }}" class="ch-m-consult">Book a Consultation →</a>

            <div class="menu-social-wrapper">
                <h4 class="social-title">Follow Us</h4>
                <div class="header-social-links">
                    @foreach ($social_media as $social)
                    @php
                    $iconName = strtolower($social->icon);
                    $brandClass = '';
                    if(strpos($iconName, 'facebook') !== false) $brandClass = 'hover-facebook';
                    elseif(strpos($iconName, 'youtube') !== false) $brandClass = 'hover-youtube';
                    elseif(strpos($iconName, 'whatsapp') !== false) $brandClass = 'hover-whatsapp';
                    elseif(strpos($iconName, 'instagram') !== false) $brandClass = 'hover-instagram';
                    elseif(strpos($iconName, 'twitter') !== false || strpos($iconName, 'x-twitter') !== false)
                    $brandClass = 'hover-twitter';
                    elseif(strpos($iconName, 'linkedin') !== false) $brandClass = 'hover-linkedin';
                    elseif(strpos($iconName, 'tiktok') !== false) $brandClass = 'hover-tiktok';
                    @endphp
                    <a href="{{ $social->link }}" class="{{ $brandClass }}" target="_blank">
                        <i class="{{ $social->icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>
    @yield('content')

    <section class="footer-area-modern" style="background:{{$settings->footer_body_background_color}}; ">
        <div class="container">
            <div class="footer-main-grid">

                <div class="footer-column brand-column">
                    <div class="column-content">
                        @if(!empty($settings->footer_logo))
                        <a href="{{ route('home') }}" class="footer-brand-logo d-inline-block mb-3">
                            <img src="{{ asset('storage/'.$settings->footer_logo) }}" alt="{{ $settings->name ?? 'Footer logo' }}" class="img-fluid" onerror="this.closest('a').remove()">
                        </a>
                        @endif
                        @if (!$footer1->isEmpty() && $footer1[0]->type==1)
                        <ul class="footer-links">
                            @foreach ($footer1 as $item)
                            <li><a target="_blank" href="{{$item->link}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul>
                        @elseif (!$footer1->isEmpty())
                        <div class="brand-raw-html">
                            {!!$footer1[0]->name!!}
                        </div>
                        @endif

                    </div>
                </div>

                <div class="">
                    <h4 class="footer-label">Branches</h4>
                    @if (!$footer2->isEmpty() && $footer2[0]->type==1)
                    <ul class="footer-links">
                        @foreach ($footer2 as $item)
                        <li><a target="_blank" href="{{$item->link}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                    @elseif (!$footer2->isEmpty())
                    {!!$footer2->first()->name!!}
                    @endif
                </div>

                <div class="">
                    <h4 class="footer-label">Quick Actions</h4>
                    @if (!$footer3->isEmpty() && $footer3[0]->type==1)
                    <ul class="footer-links">
                        @foreach ($footer3 as $item)
                        <li><a target="_blank" href="{{$item->link}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                    @elseif (!$footer3->isEmpty())
                    {!!$footer3->first()->name!!}
                    @endif
                </div>

                <div class="footer-column">
                    <h4 class="footer-label">Media</h4>
                    @if (!$footer4->isEmpty() && $footer4[0]->type==1)
                    <ul class="footer-links">
                        @foreach ($footer4 as $item)
                        <li><a target="_blank" href="{{$item->link}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                    @elseif (!$footer4->isEmpty())
                    {!!$footer4->first()->name!!}
                    @endif
                </div>

                <div class="footer-column">
                    <h4 class="footer-label">About & Support</h4>
                    @if (!$footer5->isEmpty() && $footer5[0]->type==1)
                    <ul class="footer-links">
                        @foreach ($footer5 as $item)
                        <li><a target="_blank" href="{{$item->link}}">{{$item->name}}</a></li>
                        @endforeach
                    </ul>
                    @elseif (!$footer5->isEmpty())
                    {!!$footer5->first()->name!!}
                    @endif

                </div>

            </div>

            <div class="footer-bottom-bar">
                <div class="footer-bottom-flex">

                    <div class="copyright-text">
                        {{ $settings->copyright??'' }}
                    </div>

                    <div class="modern-social-icons">
                        @foreach ($social_media as $social)
                        @php
                        $iconName = strtolower($social->icon);
                        $brandClass = '';
                        if(strpos($iconName, 'facebook') !== false) $brandClass = 'hover-facebook';
                        elseif(strpos($iconName, 'youtube') !== false) $brandClass = 'hover-youtube';
                        elseif(strpos($iconName, 'whatsapp') !== false) $brandClass = 'hover-whatsapp';
                        elseif(strpos($iconName, 'instagram') !== false) $brandClass = 'hover-instagram';
                        elseif(strpos($iconName, 'twitter') !== false || strpos($iconName, 'x-twitter') !== false)
                        $brandClass = 'hover-twitter';
                        elseif(strpos($iconName, 'linkedin') !== false) $brandClass = 'hover-linkedin';
                        elseif(strpos($iconName, 'tiktok') !== false) $brandClass = 'hover-tiktok';
                        @endphp

                        <a href="{{ $social->link }}" class="social-btn {{ $brandClass }}" target="_blank">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="body-social-links" data-aos="fade-left">
        @foreach ($social_media as $socialMedia)
        @php
        $iconName = strtolower($socialMedia->icon);
        $class = '';
        $label = '';
        if (str_contains($iconName, 'facebook')) { $class = 'facebook'; $label = 'Facebook'; }
        elseif (str_contains($iconName, 'twitter') || str_contains($iconName, 'x-logo')) { $class = 'twitter'; $label =
        'Twitter'; }
        elseif (str_contains($iconName, 'instagram')) { $class = 'instagram'; $label = 'Instagram'; }
        elseif (str_contains($iconName, 'linkedin')) { $class = 'linkedin'; $label = 'LinkedIn'; }
        elseif (str_contains($iconName, 'youtube')) { $class = 'youtube'; $label = 'YouTube'; }
        elseif (str_contains($iconName, 'whatsapp')) { $class = 'whatsapp'; $label = 'WhatsApp'; }
        elseif (str_contains($iconName, 'tiktok')) { $class = 'tiktok'; $label = 'TikTok'; }
        @endphp

        <a target="_blank" class="social-link {{ $class }}" href="{{ $socialMedia->link }}">
            <i class="{{ $socialMedia->icon }}"></i>
            <span class="link-text">{{ $label }}</span>
        </a>
        @endforeach
    </div>

    <button id="scrollTopBtn" aria-label="Scroll to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    @yield('extrajs')

    <script>
    window.APP_URL_BASE = {!! json_encode(url('/')) !!};
    </script>

    <script src="{{ asset('front_assets/js/jquery.min.js') }}" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('front_assets/swiper@11/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('front_assets/js/aos.js') }}"></script>

    <script src="{{ asset('front_assets/lightbox/lightbox.min.js') }}"></script>
    <script src="{{ asset('front_assets/magnific-popup/jquery.magnific-popup.js') }}"></script>

    <script>
    (function(){
        const hdr = document.querySelector('.main-header');
        function syncHeaderH(){
            if(!hdr) return;
            const h = hdr.offsetHeight;
            document.documentElement.style.setProperty('--header-h', h + 'px');
        }
        window.addEventListener('load', syncHeaderH);
        window.addEventListener('resize', syncHeaderH);
        if(document.fonts && document.fonts.ready) document.fonts.ready.then(syncHeaderH);
        // observe header size changes
        if(window.ResizeObserver && hdr) new ResizeObserver(syncHeaderH).observe(hdr);
        syncHeaderH();
    })();
    </script>
    <script type="module">
    AOS.init({
        duration: 900,
        once: true
    });
    </script>

    @stack('scripts')
</body>

</html>