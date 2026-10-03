@extends('layouts.admin')

@section('title')
{{__('page.dashboard')}}
@endsection

@section('content')
<div class="content pt-3">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
                <h5 class="fw-bold mb-1" style="color:#0f172a; font-size:18px;">Dashboard Overview</h5>
                <p class="text-muted small mb-0">Welcome back — Law Firm at a glance</p>
            </div>
            <span class="badge rounded-pill" style="background:#eef2ff; color:#4338ca; font-weight:600; padding:6px 12px; border:1px solid #e0e7ff;">{{ now()->format('d M Y') }}</span>
        </div>
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="background:linear-gradient(135deg,#f8fbff 0%,#ffffff 100%); border:1px solid #e0e7ff !important;">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 rounded-3 d-flex align-items-center justify-content-center" style="width:52px; height:52px; background:#e0e7ff; color:#3730a3;"><i class="fa fa-box-open fs-5"></i></div>
                        <div class="ms-3 flex-grow-1"><p class="text-muted small fw-semibold text-uppercase mb-0" style="font-size:11px; letter-spacing:0.6px;">Team Members</p><h4 class="fw-bold mb-0" style="color:#0f172a;">{{$total_teachers->count()??0}}</h4></div>
                        <i class="fa fa-chevron-right text-muted" style="font-size:12px; opacity:0.4;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="background:linear-gradient(135deg,#fdf8ff 0%,#ffffff 100%); border:1px solid #f3e8ff !important;">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 rounded-3 d-flex align-items-center justify-content-center" style="width:52px; height:52px; background:#f3e8ff; color:#7c3aed;"><i class="fa fa-users fs-5"></i></div>
                        <div class="ms-3 flex-grow-1"><p class="text-muted small fw-semibold text-uppercase mb-0" style="font-size:11px; letter-spacing:0.6px;">Sliders</p><h4 class="fw-bold mb-0" style="color:#0f172a;">{{$total_sliders??0}}</h4></div>
                        <i class="fa fa-chevron-right text-muted" style="font-size:12px; opacity:0.4;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="background:linear-gradient(135deg,#f0fdfa 0%,#ffffff 100%); border:1px solid #ccfbf1 !important;">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 rounded-3 d-flex align-items-center justify-content-center" style="width:52px; height:52px; background:#ccfbf1; color:#0d9488;"><i class="fa fa-user-gear fs-5"></i></div>
                        <div class="ms-3 flex-grow-1"><p class="text-muted small fw-semibold text-uppercase mb-0" style="font-size:11px; letter-spacing:0.6px;">Staffs</p><h4 class="fw-bold mb-0" style="color:#0f172a;">{{$staffs->count()??0}}</h4></div>
                        <i class="fa fa-chevron-right text-muted" style="font-size:12px; opacity:0.4;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="background:linear-gradient(135deg,#f0fdf4 0%,#ffffff 100%); border:1px solid #dcfce7 !important;">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 rounded-3 d-flex align-items-center justify-content-center" style="width:52px; height:52px; background:#dcfce7; color:#16a34a;"><i class="fa fa-envelope fs-5"></i></div>
                        <div class="ms-3 flex-grow-1"><p class="text-muted small fw-semibold text-uppercase mb-0" style="font-size:11px; letter-spacing:0.6px;">Unread Messages</p><h4 class="fw-bold mb-0" style="color:#0f172a;">{{$unreadContact??0}}</h4></div>
                        <i class="fa fa-chevron-right text-muted" style="font-size:12px; opacity:0.4;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="background:linear-gradient(135deg,#fffbeb 0%,#ffffff 100%); border:1px solid #fde68a !important;">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 rounded-3 d-flex align-items-center justify-content-center" style="width:52px; height:52px; background:#fef3c7; color:#d97706;"><i class="fa fa-award fs-5"></i></div>
                        <div class="ms-3 flex-grow-1"><p class="text-muted small fw-semibold text-uppercase mb-0" style="font-size:11px; letter-spacing:0.6px;">Alumni</p><h4 class="fw-bold mb-0" style="color:#0f172a;">{{($settings->alumni??0)}}</h4></div>
                        <i class="fa fa-chevron-right text-muted" style="font-size:12px; opacity:0.4;"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="background:linear-gradient(135deg,#fef2f2 0%,#ffffff 100%); border:1px solid #fecaca !important;">
                    <div class="card-body d-flex align-items-center p-3">
                        <div class="flex-shrink-0 rounded-3 d-flex align-items-center justify-content-center" style="width:52px; height:52px; background:#fee2e2; color:#dc2626;"><i class="fa fa-heart fs-5"></i></div>
                        <div class="ms-3 flex-grow-1"><p class="text-muted small fw-semibold text-uppercase mb-0" style="font-size:11px; letter-spacing:0.6px;">Donors</p><h4 class="fw-bold mb-0" style="color:#0f172a;">{{$settings->donors??0}}</h4></div>
                        <i class="fa fa-chevron-right text-muted" style="font-size:12px; opacity:0.4;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
