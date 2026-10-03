<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — {{ $settings->title ?? 'Law Firm' }}</title>
    <link rel="shortcut icon" href="{{ asset('storage/'.($settings->favicon ?? '')) }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        *{font-family: 'Inter', system-ui, -apple-system, sans-serif;}
        .login-wrapper{
            min-height:100vh; display:flex; align-items:center; justify-content:center;
            background: radial-gradient(1200px 600px at 10% -10%, #1e3a8a 0%, transparent 60%),
                        radial-gradient(900px 500px at 90% 110%, #0f172a 0%, transparent 60%),
                        linear-gradient(135deg, #0b1020 0%, #0f1b3d 45%, #00043a 100%);
            padding:24px; position:relative; overflow:hidden;
        }
        .login-wrapper::before{
            content:''; position:absolute; inset:0;
            background: url('{{ asset('admin_bg.webp') }}') center/cover no-repeat;
            opacity:0.08; mix-blend-mode: overlay;
        }
        .login-wrapper::after{
            content:''; position:absolute; width:600px; height:600px; border-radius:50%;
            background: radial-gradient(circle, rgba(78,115,223,0.15) 0%, transparent 70%);
            top:-100px; right:-150px; pointer-events:none;
        }
        .login-card{
            width:100%; max-width:440px; background: rgba(255,255,255,0.98);
            border-radius:28px; box-shadow: 0 25px 80px rgba(0,0,0,0.35), 0 10px 30px rgba(0,0,0,0.2);
            overflow:hidden; position:relative; z-index:1; backdrop-filter: blur(12px);
            border:1px solid rgba(255,255,255,0.6);
        }
        .login-header{
            background: linear-gradient(135deg, #00043a 0%, #1e293b 100%);
            padding:32px 32px 28px; text-align:center; position:relative; overflow:hidden;
        }
        .login-header::after{
            content:''; position:absolute; bottom:-1px; left:0; right:0; height:24px;
            background:#fff; border-radius:24px 24px 0 0;
        }
        .login-logo{
            width:72px; height:72px; background:#fff; border-radius:18px; display:flex; align-items:center; justify-content:center;
            margin:0 auto 14px; box-shadow:0 8px 24px rgba(0,0,0,0.25); padding:10px;
        }
        .login-logo img{ max-width:100%; max-height:100%; object-fit:contain; }
        .login-header h1{ color:#fff; font-family:'Plus Jakarta Sans', sans-serif; font-weight:800; font-size:22px; margin:0; letter-spacing:-0.5px; }
        .login-header p{ color:rgba(255,255,255,0.7); font-size:13px; margin:6px 0 0; }
        .login-body{ padding:28px 32px 32px; }
        .form-label{ font-size:13px; font-weight:700; color:#0f172a; margin-bottom:6px; display:flex; align-items:center; gap:6px; }
        .form-label i{ color:#4e73df; font-size:12px; }
        .input-wrap{ position:relative; }
        .input-wrap .form-control{
            padding:13px 14px 13px 44px; border:1.5px solid #e2e8f0; border-radius:14px; background:#f8fafc;
            font-size:14px; transition:all 0.2s; height:auto;
        }
        .input-wrap .form-control:focus{ border-color:#4e73df; background:#fff; box-shadow:0 0 0 4px rgba(78,115,223,0.12); outline:none; }
        .input-wrap .input-icon{
            position:absolute; left:14px; top:50%; transform:translateY(-50%);
            width:32px; height:32px; background:#eef2ff; border-radius:10px; display:flex; align-items:center; justify-content:center;
            color:#4e73df; font-size:14px; pointer-events:none;
        }
        .captcha-box{
            background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:14px; padding:12px; display:flex; align-items:center; gap:12px;
        }
        .captcha-box img{ border-radius:10px; height:44px; border:1px solid #e2e8f0; }
        .captcha-box input{ flex:1; border:none; background:transparent; outline:none; font-size:14px; }
        .btn-login{
            width:100%; background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            color:#fff; border:none; border-radius:14px; padding:14px; font-weight:800; font-size:15px;
            box-shadow:0 10px 24px rgba(78,115,223,0.35); transition:all 0.2s; display:flex; align-items:center; justify-content:center; gap:8px;
        }
        .btn-login:hover{ transform:translateY(-2px); box-shadow:0 14px 32px rgba(78,115,223,0.45); background: linear-gradient(135deg, #224abe 0%, #1a3a9e 100%); color:#fff; }
        .divider{ display:flex; align-items:center; gap:12px; margin:18px 0 0; color:#94a3b8; font-size:12px; }
        .divider::before,.divider::after{ content:''; flex:1; height:1px; background:#e2e8f0; }
        .footer-text{ text-align:center; margin-top:18px; font-size:12px; color:#64748b; }
        .footer-text a{ color:#4e73df; font-weight:600; text-decoration:none; }
        .alert{ border-radius:14px; font-size:13px; padding:12px 14px; border:none; }
        .is-invalid{ border-color:#ef4444 !important; background:#fef2f2 !important; }
        @media (max-width:480px){ .login-card{ border-radius:20px; } .login-body{ padding:24px 20px 28px; } .login-header{ padding:28px 20px 24px; } }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    @if(!empty($settings->admin_logo))
                        <img src="{{ asset('storage/'.$settings->admin_logo) }}" alt="Logo">
                    @elseif(!empty($settings->logo))
                        <img src="{{ asset('storage/'.$settings->logo) }}" alt="Logo">
                    @else
                        <i class="fas fa-shield-halved" style="font-size:28px;color:#00043a;"></i>
                    @endif
                </div>
                <h1>{{ $settings->short_name ?? 'Law Firm' }}</h1>
                <p>Welcome back — sign in to continue</p>
            </div>
            <div class="login-body">
                @include('shared.redirect_msg')
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="post" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                   placeholder="admin@example.com">
                        </div>
                        <x-Form::input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" required autocomplete="current-password"
                                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                   placeholder="••••••••">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-shield-halved"></i> Captcha Verification</label>
                        <div class="captcha-box">
                            <img src="{{ captcha_src() }}" alt="captcha" id="captchaImg" style="cursor:pointer;" title="Click to refresh" onclick="this.src='{{ captcha_src() }}?'+Math.random()">
                            <input type="text" name="captcha" required placeholder="Enter captcha" class="form-control-plaintext @error('captcha') is-invalid @enderror" style="border:none; background:transparent;">
                            <button type="button" onclick="document.getElementById('captchaImg').src='{{ captcha_src() }}?'+Math.random()" style="background:#fff; border:1px solid #e2e8f0; border-radius:10px; width:36px; height:36px; display:flex; align-items:center; justify-content:center; color:#4e73df;"><i class="fas fa-rotate"></i></button>
                        </div>
                        @error('captcha')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-login mt-2">
                        <span>Sign In</span> <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                <div class="divider">Secure Admin Access</div>
                <div class="footer-text">
                    &copy; {{ date('Y') }} {{ $settings->name ?? 'Law Firm' }} — All rights reserved<br>
                    <a href="{{ url('/') }}"><i class="fas fa-external-link-alt"></i> Go to Website</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
