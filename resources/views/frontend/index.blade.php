@extends('layouts.frontend')
@section('title')
{{__('page.Home')}}
@endsection

@section('content')

{{-- Chamber hero (background photo = first "Main Slider" from Admin → Slider List) --}}
<section class="ch-hero">
    @if(isset($sliders) && $sliders->count() && !empty($sliders->first()->photo))
    <img class="ch-hero-photo" src="{{ asset('storage/' . $sliders->first()->photo) }}" alt="" onerror="this.remove()">
    @endif
    <div class="container py-5">
        <div class="ch-hero-eyebrow d-flex align-items-center gap-3">ESTABLISHED 2024</div>
        <h1 class="fw-bold">LEGAL COUNSEL.<br>STRATEGIC ADVOCACY.<br>TRUSTED REPRESENTATION.</h1>
        <p class="ch-hero-sub">N.H. Talukder &amp; Associates provides professional legal representation and advisory
            services across
            Bangladesh, with a focus on integrity, research and client-centered practice.</p>
        <div class="d-grid gap-3 d-sm-flex flex-sm-wrap">
            <a href="{{ route('contact') }}" class="btn ch-btn-gold rounded-1">Book a Consultation <span>→</span></a>
            <a href="{{ route('all.details', ['info','about']) }}" class="btn ch-btn-outline rounded-1">Our Practice
                Areas <span>→</span></a>
        </div>
    </div>
</section>

{{-- Credentials strip (static design — no dynamic source yet) --}}
<section class="ch-strip">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-5 g-4">
            <div class="col">
                <div class="ch-strip-item d-flex align-items-center gap-3 h-100">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M24 6 L42 16 H6 Z" />
                        <path d="M10 16 V34 M18 16 V34 M24 16 V34 M30 16 V34 M38 16 V34" />
                        <path d="M6 34 H42 M4 40 H44 M8 40 V43 M40 40 V43" />
                    </svg>
                    <span>SUPREME COURT<br>OF BANGLADESH</span>
                </div>
            </div>
            <div class="col">
                <div class="ch-strip-item d-flex align-items-center gap-3 h-100">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M24 8 V34" />
                        <path d="M10 14 H38" />
                        <circle cx="24" cy="8" r="2.5" />
                        <path d="M10 14 L5 26 M10 14 L15 26 M5 26 H15 M38 14 L33 26 M38 14 L43 26 M33 26 H43" />
                        <path d="M17 38 H31 M20 34 V38 M28 34 V38" />
                    </svg>
                    <span>APPELLATE<br>DIVISION</span>
                </div>
            </div>
            <div class="col">
                <div class="ch-strip-item d-flex align-items-center gap-3 h-100">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M24 5 L40 14 H8 Z" />
                        <path d="M12 14 V32 M20 14 V32 M28 14 V32 M36 14 V32" />
                        <path d="M8 32 H40 M6 37 H42 M10 37 V41 M38 37 V41" />
                    </svg>
                    <span>HIGH COURT<br>DIVISION</span>
                </div>
            </div>
            <div class="col">
                <div class="ch-strip-item d-flex align-items-center gap-3 h-100">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 6 H30 L40 16 V42 H12 Z" />
                        <path d="M30 6 V16 H40" />
                        <path d="M18 24 H34 M18 29 H34 M18 34 H28" />
                    </svg>
                    <span>LEGAL ADVISORY<br>&amp; CONSULTATION</span>
                </div>
            </div>
            <div class="col">
                <div class="ch-strip-item d-flex align-items-center gap-3 h-100">
                    <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M26 8 L38 20 L30 28 L18 16 Z" />
                        <path d="M14 22 L22 30" />
                        <path d="M22 30 L10 42" />
                        <path d="M6 42 H16" />
                    </svg>
                    <span>LITIGATION &amp;<br>REPRESENTATION</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 01 / About the chamber (text dynamic from Settings → about; photo auto-shows once uploaded) --}}
<section class="ch-chamber">
    <div class="container py-5">
        <div class="row g-5 align-items-start">
            <div class="col-12 col-lg-5" data-aos="fade-right">
                <div class="ch-chamber-photo">
                    <div class="ch-photo-sign text-center">
                        <svg viewBox="0 0 52 58" fill="none" stroke="currentColor" stroke-width="3"
                            stroke-linecap="square">
                            <path
                                d="M8 10 V48 M8 10 H44 M8 18 H30 M14 18 V48 M26 18 V48 M26 18 L40 48 M40 28 V48 M40 28 H48 M48 28 V48" />
                        </svg>
                        <div class="sign-name">N.H. TALUKDER &amp; ASSOCIATES</div>
                        <div class="sign-estd">ESTD. 2024</div>
                    </div>
                    <img src="{{ asset('storage/about_image/chamber-office.png') }}" alt="The Chamber" class="img-fluid"
                        onerror="this.remove()">
                </div>
            </div>
            <div class="col-12 col-lg-4" data-aos="fade-up">
                <div class="ch-kicker d-flex align-items-center gap-2">01 <span class="ch-kicker-line"></span> ABOUT THE
                    CHAMBER</div>
                <h2>A Modern Legal Practice Grounded in Professionalism</h2>
                <p class="ch-chamber-lead">
                    @if(!empty(trim(strip_tags($settings->about ?? ''))))
                    {!! Str::limit(strip_tags($settings->about ?? ''), 260, '...') !!}
                    @else
                    N.H. Talukder &amp; Associates is a professional law chamber focused on delivering practical legal
                    solutions through advocacy, research and client-centered service.
                    @endif
                </p>
                <a href="{{ route('all.details', ['info','about']) }}" class="btn ch-btn-ghost rounded-1">Read More
                    <span>→</span></a>
            </div>
            <div class="col-12 col-lg-3" data-aos="fade-left">
                <aside class="ch-quote-card h-100">
                    <p>"Justice is not merely a matter of law, but a matter of trust."</p>
                    <span>N.H. Talukder &amp; Associates</span>
                </aside>
            </div>
        </div>
    </div>
</section>

{{-- 02 / Head of the chamber (static for now — TODO(dynamic): bind member record + portrait) --}}
<section class="ch-head">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-12 col-lg-5" data-aos="fade-right">
                <div class="ch-head-photo">
                    <div class="ch-head-initials">MN<span>H</span></div>
                    <img src="{{ asset('storage/member/head-of-chamber.jpg') }}" alt="Muha Noman Hossain"
                        class="img-fluid" onerror="this.remove()">
                    <div class="ch-head-badge">
                        <i class="fa-solid fa-scale-balanced"></i>
                        <span>Advocate<em>Supreme Court of Bangladesh</em></span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7" data-aos="fade-up">
                <div class="ch-kicker ch-kicker--light d-flex align-items-center gap-2">02 <span
                        class="ch-kicker-line"></span> HEAD OF THE CHAMBER</div>
                <h2>MUHA NOMAN HOSSAIN</h2>
                <div class="ch-head-degrees">LL.B. (Hon's, DU), LL.M. (DU)</div>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="ch-pill">Appellate Division</span>
                    <span class="ch-pill">High Court Division</span>
                    <span class="ch-pill">Supreme Court</span>
                </div>
                <div class="ch-head-adv">Advocate, Appellate &amp; High Court Division,<br>Supreme Court of Bangladesh
                </div>
                <blockquote class="ch-head-quote-inline">
                    Committed to upholding the rule of law and serving our clients with integrity and dedication.
                </blockquote>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('teachers.index') }}" class="btn ch-btn-goldline rounded-1">View Profile
                        <span>→</span></a>
                    <a href="{{ route('contact') }}" class="btn ch-btn-gold rounded-1">Book a Consultation
                        <span>→</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 03 / Practice areas (static for now — TODO(dynamic): bind practice-area records) --}}
<section class="ch-practice">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-12 col-lg-4" data-aos="fade-right">
                <div class="ch-kicker d-flex align-items-center gap-2">03 <span class="ch-kicker-line"></span> PRACTICE
                    AREAS</div>
                <h2>Our Practice Areas</h2>
                <p class="ch-practice-lead">We provide comprehensive legal services across a wide range of practice
                    areas, tailored to meet your unique needs.</p>
                <a href="{{ route('all.details', ['info','about']) }}" class="btn ch-btn-dark rounded-1">View All
                    Practice Areas <span>→</span></a>
            </div>
            <div class="col-12 col-lg-8" data-aos="fade-up">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">01</span><span
                                class="name flex-grow-1">Corporate &amp; Commercial Law</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">02</span><span
                                class="name flex-grow-1">Civil Litigation</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">03</span><span
                                class="name flex-grow-1">Criminal Law</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">04</span><span
                                class="name flex-grow-1">Constitutional Law</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">05</span><span
                                class="name flex-grow-1">Banking &amp; Finance</span><span class="arr">→</span></a>
                    </div>
                    <div class="col-12 col-md-6">
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">06</span><span
                                class="name flex-grow-1">Land &amp; Property Law</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">07</span><span
                                class="name flex-grow-1">Family Law</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">08</span><span
                                class="name flex-grow-1">Tax, VAT &amp; Customs</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">09</span><span
                                class="name flex-grow-1">Labour &amp; Employment</span><span class="arr">→</span></a>
                        <a href="{{ route('all.details', ['info','about']) }}" class="ch-pa-item d-flex align-items-center gap-3 text-decoration-none"><span class="num">10</span><span
                                class="name flex-grow-1">Arbitration &amp; Mediation</span><span class="arr">→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 04 / Legal services (static for now — TODO(dynamic): bind service records) --}}
<section class="ch-services d-flex flex-column flex-xl-row">
    <div class="ch-services-photo-strip" data-aos="fade-right">
        <img src="{{ asset('storage/sections/legal-services-bg.png') }}" alt="Legal Services"
            class="img-fluid" onerror="this.remove()">
    </div>
    <div class="ch-services-body flex-grow-1">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-12 col-xl-4" data-aos="fade-up">
                    <div class="ch-kicker ch-kicker--light d-flex align-items-center gap-2">04 <span
                            class="ch-kicker-line"></span> LEGAL SERVICES</div>
                    <h2>Comprehensive Legal Support</h2>
                    <p>From consultation to representation, we offer a full spectrum of legal services to
                        individuals, businesses and organisations.</p>
                    <a href="{{ route('contact') }}" class="btn ch-btn-goldline rounded-1">Explore All Services
                        <span>→</span></a>
                </div>
                <div class="col-12 col-xl-8" data-aos="fade-up">
                    <div class="ch-services-lists">
                        <div class="row row-cols-1 row-cols-sm-2 g-4">
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-comments"></i><span>Legal Consultation</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-magnifying-glass"></i><span>Due Diligence</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-scale-balanced"></i><span>Litigation &amp; Representation</span>
                            </div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-handshake"></i><span>Dispute Resolution</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-briefcase"></i><span>Corporate Legal Advisory</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-people-arrows"></i><span>Arbitration &amp; Mediation</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-file-signature"></i><span>Contract Review</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-clipboard-check"></i><span>Regulatory Advisory</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-folder-open"></i><span>Legal Documentation</span></div>
                        </div>
                        <div class="col" data-aos="fade-up">
                            <div class="ch-svc-item d-flex align-items-center gap-3"><i
                                    class="fa-solid fa-circle-plus"></i><span>And More</span></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 05 / Why choose us (static for now — TODO(dynamic): bind feature records) --}}
<section class="ch-why">
    <div class="container py-5">
        <div class="ch-kicker d-flex align-items-center gap-2" data-aos="fade-up">05 <span
                class="ch-kicker-line"></span> WHY CHOOSE US</div>
        <h2 data-aos="fade-up">Why N.H. Talukder &amp; Associates</h2>
        <p class="ch-why-lead" data-aos="fade-up">We are dedicated to delivering strategic legal solutions with
            integrity, expertise and a client-first approach.</p>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 mt-1">
            <div class="col" data-aos="fade-up">
                <div class="ch-why-card h-100">
                    <div class="why-num">01</div>
                    <h3>Strategic Legal Counsel</h3>
                    <p>Insightful advice for informed decisions.</p>
                </div>
            </div>
            <div class="col" data-aos="fade-up">
                <div class="ch-why-card h-100">
                    <div class="why-num">02</div>
                    <h3>Courtroom Representation</h3>
                    <p>Strong advocacy, experienced in complex matters.</p>
                </div>
            </div>
            <div class="col" data-aos="fade-up">
                <div class="ch-why-card h-100">
                    <div class="why-num">03</div>
                    <h3>Confidential &amp; Client-Centered</h3>
                    <p>Your matters, our priority.</p>
                </div>
            </div>
            <div class="col" data-aos="fade-up">
                <div class="ch-why-card h-100">
                    <div class="why-num">04</div>
                    <h3>Research-Driven Analysis</h3>
                    <p>In-depth research for better outcomes.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="impact-section">
    <div class="container">
        <div class="impact-header text-center" data-aos="fade-down">
            <span class="tag">Our Impact</span>
            <h2 class="premium-title">Law Firm Statistics</h2>
            <div class="h-line"></div>
        </div>

        <div class="impact-main-wrapper">
            <div class="impact-column left-side">
                <div class="stat-card" data-aos="fade-right" data-aos-delay="100">
                    <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-info">
                        <h1 class="counter golden-text" data-target="{{ $members->count() }}">{{ $members->count() }}
                        </h1>
                        <p>Team Members</p>
                    </div>
                </div>
                <div class="stat-card" data-aos="fade-right" data-aos-delay="200">
                    <div class="stat-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <div class="stat-info">
                        <h1 class="counter golden-text" data-target="{{ $settings->teachers }}">
                            {{ $settings->teachers }}</h1>
                        <p>Teachers</p>
                    </div>
                </div>
                <div class="stat-card" data-aos="fade-right" data-aos-delay="300">
                    <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="stat-info">
                        <h1 class="counter golden-text"
                            data-target="{{($settings->male_students ?? 0) + ($settings->female_students ?? 0)}}">
                            {{($settings->male_students ?? 0) + ($settings->female_students ?? 0)}}</h1>
                        <p>Total Students</p>
                    </div>
                </div>
            </div>

            <div class="impact-image-container" data-aos="zoom-in">
                <div class="main-glow"></div>
                <div class="iconic-frame">
                    <img src="{{asset('storage/' . $settings->about_center_image)}}" alt="Law Firm Center">
                </div>
                <div class="orbit-decoration"></div>
            </div>

            <div class="impact-column right-side">
                <div class="stat-card" data-aos="fade-left" data-aos-delay="100">
                    <div class="stat-icon"><i class="fa-solid fa-award"></i></div>
                    <div class="stat-info">
                        <h1 class="counter golden-text" data-target="{{ $settings->alumni ?? 0 }}">
                            {{ $settings->alumni ?? 0 }}</h1>
                        <p>Alumni</p>
                    </div>
                </div>
                <div class="stat-card" data-aos="fade-left" data-aos-delay="200">
                    <div class="stat-icon"><i class="fa-solid fa-users-gear"></i></div>
                    <div class="stat-info">
                        <h1 class="counter golden-text" data-target="{{ $settings->staffs }}">{{ $settings->staffs }}
                        </h1>
                        <p>Staffs</p>
                    </div>
                </div>
                <div class="stat-card" data-aos="fade-left" data-aos-delay="300">
                    <div class="stat-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    <div class="stat-info">
                        <h1 class="counter golden-text" data-target="{{ $settings->donors ?? 0 }}">
                            {{ $settings->donors ?? 0 }}</h1>
                        <p>Donors</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
{{-- 06 / Our team (dynamic: members; arrows scroll the track) --}}
<section class="ch-team">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-12 col-lg-3" data-aos="fade-right">
                <div class="ch-kicker ch-kicker--light d-flex align-items-center gap-2">06 <span
                        class="ch-kicker-line"></span> OUR TEAM</div>
                <h2>Our Team of Legal Professionals</h2>
                <p class="ch-team-lead">A skilled team of advocates, associates and legal experts, working together for
                    your success.</p>
                <a href="{{ route('teachers.index') }}" class="btn ch-btn-goldline rounded-1">Meet Our Team
                    <span>→</span></a>
            </div>
            <div class="col-12 col-lg-9" data-aos="fade-up">
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <button type="button" class="ch-arrow" aria-label="Previous"
                        onclick="document.getElementById('chTeamTrack').scrollBy({left: -300, behavior: 'smooth'})">‹</button>
                    <button type="button" class="ch-arrow" aria-label="Next"
                        onclick="document.getElementById('chTeamTrack').scrollBy({left: 300, behavior: 'smooth'})">›</button>
                </div>
                <div id="chTeamTrack" class="ch-team-track d-flex gap-3">
                    @foreach ($members as $member)
                    <article class="ch-team-card">
                        <div class="ch-team-photo">
                            <div class="ch-team-initials">
                                {{ strtoupper(implode('', array_map(fn($w) => mb_substr($w, 0, 1), array_slice(preg_split('/\s+/', trim($member->name)), 0, 2)))) }}
                            </div>
                            @if(!empty($member->photo))
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}"
                                class="img-fluid" loading="lazy" onerror="this.remove()">
                            @endif
                            <div class="ch-team-meta">
                                <h3>{{ $member->name }}</h3>
                                <span>{{ $member->designations->pluck('designation.name')->implode(', ') }}</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 07 / Insights & legal research (dynamic: latest news) --}}
<section class="ch-insights">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-12 col-lg-3" data-aos="fade-right">
                <div class="ch-kicker d-flex align-items-center gap-2">07 <span class="ch-kicker-line"></span> INSIGHTS
                    &amp; LEGAL RESEARCH</div>
                <h2>Latest Insights</h2>
                <p class="ch-insights-lead">Stay updated with our articles, case analyses and legal developments.</p>
                <a href="{{ route('news', 'News') }}" class="btn ch-btn-dark rounded-1">View All <span>→</span></a>
            </div>
            <div class="col-12 col-lg-9" data-aos="fade-up">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-4">
                    @foreach($news as $item)
                    <div class="col">
                        <article class="ch-insight-card h-100"
                            onclick="window.location='{{ route('news.details', ['slug' => $item->slug ?? '#']) }}'">
                            <div class="ch-insight-img">
                                @if(!empty($item->photo))
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}"
                                    class="img-fluid" loading="lazy" onerror="this.remove()">
                                @endif
                            </div>
                            <div class="ch-insight-body">
                                <span
                                    class="ch-insight-cat">{{ strtoupper($item->categories->first()?->category?->name ?? 'ARTICLE') }}</span>
                                <h3>{{ Str::limit($item->name, 60) }}</h3>
                                <span class="ch-insight-date"><i class="fa-regular fa-calendar"></i>
                                    {{ $item->action_date ? \Carbon\Carbon::parse($item->action_date)->format('d F Y') : ($item->created_at ? $item->created_at->format('d F Y') : '') }}</span>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Modern Home Image Gallery - Bento / Masonry modern design --}}
<section class="home-gallery-area">
    <div class="container">
        <div class="news-header" data-aos="fade-down">
            <div class="header-title-box">
                <span class="video-tagline">Captured Moments</span>
                <h3>Image Gallery</h3>
                <div class="video-title-line"></div>
            </div>
            <a href="{{ route('image') }}" class="btn-see-all">
                See All <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>
        @if(isset($galleryImages) && $galleryImages->count() > 0)
        <div class="home-gallery-grid" data-aos="fade-up">
            @foreach($galleryImages as $g)
            @php $isBento = $loop->iteration === 1 || $loop->iteration === 6; @endphp
            <a href="{{ asset('storage/'.$g->photo) }}"
                class="gallery-card lightbox_click {{ $isBento ? 'gallery-card--wide' : '' }}"
                data-lightbox="home-gallery" data-title="{{ $g->name }}" data-aos="zoom-in"
                data-aos-delay="{{ $loop->iteration * 40 }}">
                <img src="{{ asset('storage/'.$g->photo) }}" alt="{{ $g->name }}" loading="lazy" decoding="async">
                <div class="gallery-overlay">
                    <span class="gallery-zoom"><i class="fas fa-expand"></i></span>
                    @if($g->name)<span class="gallery-name">{{ Str::limit($g->name, 32) }}</span>@endif
                </div>
                <span class="gallery-shine"></span>
            </a>
            @endforeach
        </div>
        @else
        <div class="gallery-empty" data-aos="fade-up">
            <div class="gallery-empty-icon"><i class="fas fa-images"></i></div>
            <p>No gallery images yet. Add from <strong>Admin → Image & Videos Album → Album Image</strong> and set
                status active.</p>
        </div>
        @endif
    </div>
</section>

<section class="location-area">
    <div class="location-glow-top"></div>
    <div class="location-glow-bottom"></div>

    <div class="container">
        <div class="section-heading mb-50" data-aos="fade-down">
            <span class="sub-title">Find Us</span>
            <h3>Our Location</h3>
            <div class="location-title-line"></div>
        </div>

        @php $singleLocation = $locations->first(); @endphp
        @if($singleLocation)
        <div class="location-content-panel location-single" data-aos="fade-up" data-aos-delay="100">
            <div class="map-window-header">
                <div class="indicator-pulse"></div>
                <h4><i class='bx bx-map-pin'></i> {{ $singleLocation->name }}</h4>
            </div>

            <div class="iframe map_iframe">
                {!! $singleLocation->map_link !!}
            </div>
        </div>
        @endif
    </div>
</section>

{{-- 08 / Client testimonials (static for now — TODO(dynamic): bind testimonial records) --}}
<section class="ch-testimonials">
    <div class="container py-5">
        <div class="text-center mx-auto ch-testimonials-head" data-aos="fade-down">
            <div class="ch-kicker d-flex align-items-center justify-content-center gap-2">08 <span class="ch-kicker-line"></span> CLIENT TESTIMONIALS</div>
            <h2>What Our Clients Say</h2>
            <p>We take pride in the trust and confidence our clients place in us.</p>
        </div>
        <div class="ch-t-stage mx-auto" data-aos="fade-up">
            <div class="ch-t-track">
                <div class="ch-t-slide">
                    <div class="ch-t-mark">&ldquo;</div>
                    <div class="ch-t-stars">★★★★★</div>
                    <p>N.H. Talukder &amp; Associates provided exceptional legal support in our case. Their professionalism, timely communication and strategic approach were of great assistance.</p>
                    <div class="ch-t-person">
                        <span class="ch-t-avatar">RG</span>
                        <span class="ch-t-who"><strong>Rahman Group</strong><em>Corporate Client</em></span>
                    </div>
                </div>
                <div class="ch-t-slide">
                    <div class="ch-t-mark">&ldquo;</div>
                    <div class="ch-t-stars">★★★★★</div>
                    <p>From our first consultation to the final verdict, the chamber handled everything with remarkable diligence and honesty. I always felt informed and protected.</p>
                    <div class="ch-t-person">
                        <span class="ch-t-avatar">PC</span>
                        <span class="ch-t-who"><strong>Private Client</strong><em>Dhaka</em></span>
                    </div>
                </div>
                <div class="ch-t-slide">
                    <div class="ch-t-mark">&ldquo;</div>
                    <div class="ch-t-stars">★★★★★</div>
                    <p>Their research-driven approach and confident courtroom advocacy delivered exactly the outcome our business needed. A truly trusted legal partner.</p>
                    <div class="ch-t-person">
                        <span class="ch-t-avatar">BC</span>
                        <span class="ch-t-who"><strong>Business Client</strong><em>Chattogram</em></span>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center gap-3 mt-4">
                <button type="button" class="ch-t-arrow" aria-label="Previous" onclick="chTMove(-1)">‹</button>
                <div class="d-flex gap-2" id="chTDots"></div>
                <button type="button" class="ch-t-arrow" aria-label="Next" onclick="chTMove(1)">›</button>
            </div>
        </div>
        <div class="ch-cta-strip mx-auto d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3" data-aos="fade-up">
            <h3>Your Legal Matters, Our Priority</h3>
            <a href="{{ route('contact') }}" class="btn ch-btn-gold rounded-1 text-nowrap">Request a Consultation <span>→</span></a>
        </div>
    </div>
</section>
<script>
(function () {
    var idx = 0, timer = null;
    var track = document.querySelector('.ch-t-track');
    if (!track) return;
    var slides = track.children.length;
    var dotsBox = document.getElementById('chTDots');
    for (var i = 0; i < slides; i++) {
        var d = document.createElement('button');
        d.type = 'button';
        d.className = 'ch-t-dot';
        d.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
        (function (n) { d.onclick = function () { chTGo(n); }; })(i);
        dotsBox.appendChild(d);
    }
    function paint() {
        track.style.transform = 'translateX(-' + (idx * 100) + '%)';
        var dots = dotsBox.children;
        for (var i = 0; i < dots.length; i++) dots[i].classList.toggle('on', i === idx);
    }
    window.chTGo = function (n) { idx = (n + slides) % slides; paint(); restart(); };
    window.chTMove = function (s) { idx = (idx + s + slides) % slides; paint(); restart(); };
    function restart() { if (timer) clearInterval(timer); timer = setInterval(function () { idx = (idx + 1) % slides; paint(); }, 6000); }
    paint(); restart();
})();
</script>

{{-- 09 / Get in touch (info dynamic from Settings; form posts to contact.submit) --}}
<section class="ch-contact">
    <div class="container py-5">
        <div class="text-center mx-auto ch-contact-head" data-aos="fade-down">
            <div class="ch-kicker ch-kicker--light d-flex align-items-center justify-content-center gap-2">09 <span
                    class="ch-kicker-line"></span> CONTACT</div>
            <h2>Get In Touch</h2>
            <p>We are here to assist you. Contact us for consultation, inquiries or more information.</p>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 mb-4">
            <div class="col" data-aos="fade-up">
                <div class="ch-contact-tile h-100 text-center">
                    <i class="fa-solid fa-phone"></i>
                    <h3>Phone</h3>
                    <span>{{ $settings->phone ?? '+880 1716-234555' }}<br>{{ '+880 1811-678901' }}</span>
                </div>
            </div>
            <div class="col" data-aos="fade-up">
                <div class="ch-contact-tile h-100 text-center">
                    <i class="fa-solid fa-envelope"></i>
                    <h3>Email</h3>
                    <span>{{ $settings->email ?? 'info@lawfirm.com' }}</span>
                </div>
            </div>
            <div class="col" data-aos="fade-up">
                <div class="ch-contact-tile h-100 text-center">
                    <i class="fa-solid fa-building-columns"></i>
                    <h3>Supreme Court Chamber</h3>
                    <span>Room No. 307 (Annex), Supreme Court of Bangladesh, Dhaka-1000</span>
                </div>
            </div>
            <div class="col" data-aos="fade-up">
                <div class="ch-contact-tile h-100 text-center">
                    <i class="fa-solid fa-moon"></i>
                    <h3>Evening Chamber</h3>
                    <span>House 17, Road 5, Sector 7, Uttara, Dhaka-1230</span>
                </div>
            </div>
        </div>
        <div class="ch-contact-panel" data-aos="fade-up">
            <div class="row g-0">
                <div class="col-12 col-lg-7">
                    <div class="ch-contact-form h-100">
                        <h3>Send a Message</h3>
                        @if(session('success'))
                        <div class="alert alert-success py-2 small">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <input type="text" name="website" value="" style="display:none;" tabindex="-1"
                                autocomplete="off">
                            <input type="hidden" name="subject" value="Website Contact Form">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3"><input type="text" name="name"
                                        value="{{ old('name') }}" class="form-control" placeholder="Name *" required>
                                </div>
                                <div class="col-12 col-md-6 mb-3"><input type="text" name="phone"
                                        value="{{ old('phone') }}" class="form-control" placeholder="Phone *"></div>
                            </div>
                            <div class="mb-3"><input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="Email *" required></div>
                            <div class="mb-3"><textarea name="message" rows="4" class="form-control"
                                    placeholder="Write your message *" required>{{ old('message') }}</textarea></div>
                            <button type="submit" class="btn ch-btn-gold rounded-1">Send Message <span>→</span></button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="ch-contact-photo h-100">
                        <img src="{{ asset('storage/sections/contact-panel.png') }}" alt="Chamber" class="img-fluid"
                            onerror="this.remove()">
                        <div class="ch-hours-badge">
                            <i class="fa-regular fa-clock"></i>
                            <div><strong>Sun – Thu</strong><span>9:00 AM – 6:00 PM</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function copyNoticeLink(url, btn) {
    const doCopy = (text) => {
        if (navigator.clipboard && window.isSecureContext) {
            return navigator.clipboard.writeText(text);
        } else {
            const ta = document.createElement('textarea');
            ta.value = text;
            ta.style.position = 'fixed';
            ta.style.opacity = '0';
            document.body.appendChild(ta);
            ta.select();
            try {
                document.execCommand('copy');
            } catch (e) {}
            document.body.removeChild(ta);
            return Promise.resolve();
        }
    };
    doCopy(url).then(() => {
        const fb = btn ? btn.parentElement.querySelector('.copy-feedback') : null;
        if (fb) {
            fb.style.display = 'inline';
            setTimeout(() => fb.style.display = 'none', 1800);
        }
        if (btn) {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied';
            setTimeout(() => btn.innerHTML = orig, 1800);
        }
    });
}
</script>
@endpush
@endsection