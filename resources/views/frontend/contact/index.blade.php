@extends('layouts.frontend')
@section('title', 'Contact Us')
@section('content')
<style>
* {
    box-sizing: border-box;
}

.contact-hero {
    background: radial-gradient(900px 400px at 50% 0%, rgba(201, 164, 92, 0.16), transparent 60%),
    linear-gradient(135deg, #141210 0%, #1d1a15 55%, #241c12 100%);
    background-size: cover;
    background-position: center;
    padding: 50px 16px 60px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid rgba(201, 164, 92, 0.25);
}

.contact-hero::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 80px;
    background: #f5f0e4;
    clip-path: ellipse(70% 100% at 50% 100%);
    z-index: 1;
}

.contact-hero h1 {
    font-family: "Playfair Display", Georgia, serif;
    font-size: clamp(28px, 5vw, 44px);
    font-weight: 700;
    margin-bottom: 10px;
    position: relative;
    z-index: 2;
    color: #e7cd97;
    letter-spacing: 0.01em;
}

.contact-hero p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    line-height: 1.6;
    background: rgba(255, 255, 255, 0.08);
    padding: 8px 16px;
    border-radius: 999px;
    display: inline-block;
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.contact-hero .breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.1);
    padding: 6px 14px;
    border-radius: 40px;
    font-size: 13px;
    margin-bottom: 16px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
    z-index: 2;
}

.contact-hero .breadcrumb a {
    color: #e7cd97;
}

.contact-main-section {
    padding: 32px 0 40px;
    background: #f5f0e4;
    position: relative;
    z-index: 2;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    align-items: start;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 12px;
}

@media(min-width:992px) {
    .contact-grid {
        grid-template-columns: 1.1fr 0.9fr;
        gap: 32px;
        padding: 0 15px;
    }

    .contact-hero {
        padding: 60px 0 70px;
    }
}

.contact-form-wrapper {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(13, 27, 62, 0.06);
    border: 1px solid rgba(201, 150, 42, 0.12);
    width: 100%;
    max-width: 100%;
    overflow: hidden;
}

@media(min-width:576px) {
    .contact-form-wrapper {
        padding: 28px;
    }
}

.contact-form-wrapper h3 {
    font-family: "Playfair Display", Georgia, serif;
    font-size: 24px;
    font-weight: 600;
    color: #191510;
    margin-bottom: 6px;
}

.form-subtitle {
    color: #64748b;
    margin-bottom: 20px;
    font-size: 14px;
}

.form-group-modern {
    margin-bottom: 14px;
    width: 100%;
}

.form-group-modern label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #2a251c;
    margin-bottom: 6px;
}

.form-group-modern label .required {
    color: #ef4444;
}

.form-group-modern input:focus,
.form-group-modern textarea:focus,
.form-group-modern select:focus {
    outline: none;
    border-color: #c9a45c;
    box-shadow: 0 0 0 4px rgba(201, 164, 92, 0.16);
    background: #fff;
}
.form-group-modern input,
.form-group-modern textarea,
.form-group-modern select {
    width: 100%;
    max-width: 100%;
    padding: 12px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    background: #f8fafc;
    transition: 0.2s;
    display: block;
    color: #2a251c;
}

.form-group-modern textarea {
    min-height: 120px;
    resize: vertical;
}

.form-row-2 {
    display: grid;
    grid-template-columns: 1fr;
    gap: 12px;
}

@media(min-width:576px) {
    .form-row-2 {
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
}

.submit-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 24px;
    background: linear-gradient(180deg, #ddbb77 0%, #c39a52 100%);
    color: #1a1408;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    width: 100%;
    justify-content: center;
    box-shadow: 0 8px 22px rgba(201, 164, 92, 0.3);
}
.submit-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 12px 28px rgba(201, 164, 92, 0.4);
}

.contact-info-side {
    display: flex;
    flex-direction: column;
    gap: 14px;
    width: 100%;
}

.contact-info-card {
    background: #fff;
    border-radius: 16px;
    padding: 16px;
    box-shadow: 0 6px 20px rgba(13, 27, 62, 0.05);
    border: 1px solid rgba(201, 150, 42, 0.1);
    display: flex;
    gap: 12px;
    align-items: flex-start;
    width: 100%;
    overflow: hidden;
}

.contact-info-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    background: linear-gradient(180deg, #ddbb77 0%, #c39a52 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #1a1408;
    flex-shrink: 0;
}

.contact-info-text h4 {
    font-family: "Playfair Display", Georgia, serif;
    font-size: 15px;
    font-weight: 700;
    color: #191510;
    margin-bottom: 4px;
}

.contact-info-text p {
    font-size: 13px;
    color: #475569;
    line-height: 1.5;
    margin: 0;
    word-break: break-word;
}

.contact-info-text p a {
    color: #2a251c;
    word-break: break-all;
}

.map-section {
    padding: 32px 0 48px;
    background: #141210;
    border-top: 1px solid rgba(201, 164, 92, 0.25);
}

.map-section .map-container {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(201, 164, 92, 0.3);
    height: 300px;
    width: 100%;
}

@media(max-width:576px) {
    .map-section .map-container {
        height: 220px;
    }

    .contact-social-links a {
        width: 36px;
        height: 36px;
        font-size: 16px;
    }
}

.contact-social-links {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 8px;
}

.contact-social-links a {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #2a251c;
    font-size: 16px;
    transition: 0.2s;
}
.contact-social-links a:hover {
    background: linear-gradient(180deg, #ddbb77 0%, #c39a52 100%);
    color: #1a1408;
}
</style>
<section class="contact-hero">
    <div class="container" style="max-width:1200px; margin:0 auto; padding:0 12px;">
        <div class="breadcrumb"><a href="{{ route('home') }}">Home</a><span>›</span><span
                style="color:rgba(255,255,255,0.5);">Contact</span></div>
        <h1 data-aos="fade-up">Contact Us</h1>
        <p data-aos="fade-up" data-aos-delay="80">Have questions? Reach out — we’re here to help.</p>
    </div>
</section>
<section class="contact-main-section">
    <div class="contact-grid">
        <div class="contact-form-wrapper" data-aos="fade-up">
            <h3>Send a Message</h3>
            <p class="form-subtitle">We’ll get back to you as soon as possible. Your message goes directly to dashboard.
            </p>
            @if(session('success'))<div
                style="background:#ecfdf5; border:1px solid #a7f3d0; color:#065f46; padding:12px; border-radius:10px; margin-bottom:16px; font-size:13px;">
                {{ session('success') }}</div>@endif
            @if($errors->any())<div
                style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; padding:12px; border-radius:10px; margin-bottom:16px; font-size:13px;">
                <ul style="margin:0; padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>@endif
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div style="position:absolute; left:-5000px; top:auto; width:1px; height:1px; overflow:hidden;">
                    <label>Leave this field empty</label><input type="text" name="website" value="" autocomplete="off"
                        tabindex="-1"></div>
                <div class="form-row-2">
                    <div class="form-group-modern"><label>Full Name <span class="required">*</span></label><input
                            type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required>
                    </div>
                    <div class="form-group-modern"><label>Email <span class="required">*</span></label><input
                            type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                    </div>
                </div>
                <div class="form-row-2">
                    <div class="form-group-modern"><label>Phone</label><input type="tel" name="phone"
                            value="{{ old('phone') }}" placeholder="Your phone"></div>
                    <div class="form-group-modern"><label>Subject <span class="required">*</span></label>
                        <select name="subject" required>
                            <option value="">Select a subject</option>
                            <option value="general" {{ old('subject')=='general'?'selected':'' }}>General Inquiry
                            </option>
                            <option value="consultation" {{ old('subject')=='consultation'?'selected':'' }}>Book a Consultation</option>
                            <option value="criminal" {{ old('subject')=='criminal'?'selected':'' }}>Criminal Defense &amp; Litigation</option>
                            <option value="civil-property" {{ old('subject')=='civil-property'?'selected':'' }}>Civil &amp; Property Law</option>
                            <option value="family" {{ old('subject')=='family'?'selected':'' }}>Family &amp; Personal Law</option>
                            <option value="corporate" {{ old('subject')=='corporate'?'selected':'' }}>Corporate &amp; Commercial Law</option>
                            <option value="other" {{ old('subject')=='other'?'selected':'' }}>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group-modern"><label>Message <span class="required">*</span></label><textarea
                        name="message" placeholder="Write your message..." required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Send Message</button>
            </form>
        </div>
        <div class="contact-info-side" data-aos="fade-up" data-aos-delay="80">
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="fas fa-map-pin"></i></div>
                <div class="contact-info-text">
                    <h4>Our Location</h4>
                    <p>Uttara, Dhaka – 1230<br>Bangladesh</p>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="fas fa-phone-alt"></i></div>
                <div class="contact-info-text">
                    <h4>Phone</h4>
                    <p><a href="tel:{{ $settings->phone ?? '' }}">{{ $settings->phone ?? '+8801XXXXXXXXX' }}</a></p>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="fas fa-envelope"></i></div>
                <div class="contact-info-text">
                    <h4>Email</h4>
                    <p><a href="mailto:{{ $settings->email ?? '' }}">{{ $settings->email ?? 'info@LawFirm.com' }}</a>
                    </p>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon"><i class="fas fa-clock"></i></div>
                <div class="contact-info-text">
                    <h4>Office Hours</h4>
                    <p>Sunday – Thursday: 9:00 AM – 6:00 PM<br>Friday & Saturday: Closed</p>
                </div>
            </div>
            <div class="contact-info-card" style="flex-direction:column; align-items:flex-start;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div class="contact-info-icon" style="width:38px; height:38px; min-width:38px; font-size:16px;"><i
                            class="fas fa-share-alt"></i></div>
                    <h4 style="margin:0; font-size:14px;">Follow Us</h4>
                </div>
                <div class="contact-social-links">@foreach($social_media as $social)<a href="{{ $social->link }}"
                        target="_blank"><i class="{{ $social->icon }}"></i></a>@endforeach</div>
            </div>
        </div>
    </div>
</section>
@if(!empty($settings->map_link))
<section class="map-section">
    <div class="container" style="max-width:1200px; margin:0 auto; padding:0 12px;">
        <div class="section-heading" style="text-align:center; margin-bottom:16px;"><span class="sub-title"
                style="color:#c9a45c; font-weight:700; font-size:12px; letter-spacing:3px;">FIND US</span>
            <h3 style="font-family:'Playfair Display',Georgia,serif; font-weight:600; color:#f3ead6;">Our Location</h3>
        </div>
        <div class="map-container" data-aos="fade-up">{!! $settings->map_link !!}</div>
    </div>
</section>
@endif
@endsection