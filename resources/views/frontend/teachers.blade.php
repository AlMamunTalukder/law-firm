@extends('layouts.frontend')

@section('title')
    Our Team
@endsection

@section('content')
<div class="content">
    <section class="team-area">
        <div class="container">
            <div class="section-heading mb-50" data-aos="fade-down">

                <h3>Our Team</h3>
                <div class="title-divider"></div>
            </div>

            <div class="teamContainer">
                @forelse ($members as $member)
                <div class="teamContainer-card" data-aos="fade-up">
                    <div class="member-img-wrapper">
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}">
                        <div class="socials-overlay">
                            <div class="socials-links">
                                @if($member->facebook)
                                    <a href="{{ $member->facebook }}" class="social-icon" target="_blank" title="Facebook"><i class='bx bxl-facebook'></i></a>
                                @endif
                                @if($member->twitter)
                                    <a href="{{ $member->twitter }}" class="social-icon" target="_blank" title="Twitter"><i class="bx bxl-twitter"></i></a>
                                @endif
                                @if($member->linkedin)
                                    <a href="{{ $member->linkedin }}" class="social-icon" target="_blank" title="LinkedIn"><i class='bx bxl-linkedin'></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <h2 class="name">{{ $member->name }}</h2>
                        <h5 class="role">{{ $member->designations->pluck('designation.name')->implode(', ') }}</h5>
                        <p class="desc">{!! Str::limit(strip_tags($member->description), 110) !!}</p>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p>No team members found.</p>
                </div>
                @endforelse
            </div>
            <div class="pagination-area">
                <div class="row">
                    <div class="col-md-12 mb-35">
                        {!! $members->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
