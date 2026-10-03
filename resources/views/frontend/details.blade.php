@extends('layouts.frontend')

@section('title', $type == 'info' ? ($item->about_title ?? 'About Us') : ($item->title ?? $item->notice_title ??
'Notice'))

@section('content')
<style>
/* Quill editor formatting (alignment, tables, media) shown on frontend */
.details-rich-content .ql-align-center {
    text-align: center;
}

.details-rich-content .ql-align-right {
    text-align: right;
}

.details-rich-content .ql-align-justify {
    text-align: justify;
}

.details-rich-content .ql-direction-rtl {
    direction: rtl;
    text-align: right;
}

.details-rich-content table {
    border-collapse: collapse;
    width: 100%;
    margin: 12px 0;
}

.details-rich-content td,
.details-rich-content th {
    border: 1px solid #cbd5e1;
    padding: 8px;
}

.details-rich-content img,
.details-rich-content video {
    max-width: 100%;
    height: auto;
}

.details-rich-content blockquote {
    border-left: 4px solid #c9962a;
    margin: 12px 0;
    padding: 8px 16px;
    color: #475569;
}

.details-rich-content pre {
    background: #0f172a;
    color: #e2e8f0;
    padding: 12px 16px;
    border-radius: 8px;
    overflow-x: auto;
}
</style>

@if($type == 'info')

<div class="container">
    <div class="magazine-image-viewport" data-aos="fade-up">
        @if($item->about_image)
        <img src="{{ asset('storage/'.$item->about_image) }}" alt="About Image">
        @else
        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#999;">No
            image available</div>
        @endif
    </div>
    <div class="page-header-title" data-aos="fade-up" style="margin-top: -30px; margin-bottom: 30px;">
        <h2>{{ $item->about_title ?? 'About Us' }}</h2>
    </div>
</div>
@endif

<section class="single-page-main-area {{ $type == 'notice' ? 'notice-page-spacing' : '' }}">
    <div class="container">
        <div class="single-page-wrapper">
            <div class="left-side-content {{ $type == 'notice' ? 'notice-details' : '' }}" data-aos="fade-right">
                @if($type == 'notice')
                <div
                    style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-bottom:12px;">
                    <h2 class="notice-title" style="flex:1; min-width:220px; margin:0;">
                        {{ $item->title ?? ($item->notice_title ?? 'Notice') }}
                    </h2>
                    <button type="button" onclick="copyNoticeLink('{{ route('notice.short', $item->id) }}', this)"
                        style="display:inline-flex; align-items:center; gap:7px; background:#fff; color:#0f172a; border:1.5px solid #e2e8f0; padding:8px 14px; border-radius:999px; font-size:12px; font-weight:700; cursor:pointer; white-space:nowrap; flex-shrink:0;"><i
                            class="fas fa-link" style="font-size:11px;"></i> Copy Link <span class="copy-feedback"
                            style="font-size:11px; color:#059669; display:none; margin-left:4px;">Copied!</span></button>
                </div>
                <div class="notice-meta-row"
                    style="display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin:0 0 12px;">
                    <span
                        style="background:#eef5ff; color:#1d4ed8; font-size:12px; font-weight:700; padding:5px 10px; border-radius:999px;">Notice</span>
                    @if(!empty($item->created_at))<span style="color:#64748b; font-size:13px;"><i class="bx bx-calendar"
                            style="vertical-align:-1px;"></i> {{ $item->created_at->format('d M, Y') }}</span>@endif
                    <span style="color:#94a3b8;">•</span>
                    <span style="color:#64748b; font-size:13px;"><i class="bx bx-show"></i> {{ $item->views ?? 0 }}
                        views</span>
                </div>
                @if(!empty($item->photo))
                <div
                    style="margin:0 0 18px; border-radius:18px; overflow:hidden; border:1px solid #e2e8f0; box-shadow:0 10px 30px rgba(13,27,62,0.08);">
                    <img src="{{ asset('storage/'.$item->photo) }}" alt="{{ $item->title }}"
                        style="width:100%; height:auto; display:block;">
                </div>
                @endif
                @endif
                <div class="details-rich-content">
                    {!! $type == 'info' ? $item->about : ($item->content ?? $item->notice) !!}
                </div>
            </div>
            <div class="right-side-branch-list" data-aos="fade-left">
                @if($type == 'notice')
                <h4><i class='bx bx-notepad'></i> Other Notices</h4>
                <ul>
                    @forelse($sideNotices as $notice)
                    <li>
                        <a href="{{ route('notices.show', $notice->slug) }}">
                            <i class='bx bx-chevron-right'></i> {{ $notice->title }}
                        </a>
                    </li>
                    @empty
                    <li>
                        <a href="{{ route('notices.index') }}">
                            <i class='bx bx-chevron-right'></i> View all notices
                        </a>
                    </li>
                    @endforelse
                </ul>
                @else
                <h4><i class='bx bx-link'></i> Quick Links</h4>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">
                            <i class='bx bx-chevron-right'></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('notices.index') }}">
                            <i class='bx bx-chevron-right'></i> Notices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}">
                            <i class='bx bx-chevron-right'></i> Contact
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

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
        const fb = btn ? btn.querySelector('.copy-feedback') || btn.parentElement.querySelector(
            '.copy-feedback') : null;
        if (fb) {
            fb.style.display = 'inline';
            fb.textContent = 'Copied!';
            setTimeout(() => fb.style.display = 'none', 1800);
        }
        if (btn && !btn.querySelector('.copy-feedback')) {
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied';
            setTimeout(() => btn.innerHTML = orig, 1800);
        }
    });
}
document.querySelectorAll('.single-branch-info').forEach(card => {
    card.addEventListener('click', function(e) {
        if (!e.target.closest('.details-link')) {
            const link = this.querySelector('.details-link');
            if (link) window.location.href = link.href;
        }
    });
});
</script>
@endpush