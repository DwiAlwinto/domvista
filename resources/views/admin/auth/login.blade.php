<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="shortcut icon" href="{{ asset('logo/domlog.png') }}" type="image/x-icon">
    <title>DOMVISTA</title>
    <!-- CSS files -->
    <link href="/vendor/admin/dist/css/tabler.min.css?1738096682" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-flags.min.css?1738096682" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-socials.min.css?1738096682" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-payments.min.css?1738096682" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-vendors.min.css?1738096682" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/tabler-marketing.min.css?1738096682" rel="stylesheet"/>
    <link href="/vendor/admin/dist/css/demo.min.css?1738096682" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');
    </style>
</head>
<body class="d-flex flex-column">
    <script src="/vendor/admin/dist/js/demo-theme.min.js?1738096682"></script>
    <div class="page">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="{{ url('/') }}" class="d-flex align-items-center justify-content-center text-decoration-none hover-effect">
                                <!-- Gambar logo -->
                              <img src="{{ asset('logo/VISTA.png') }}" 
                                alt="Windo Logo"
                                class="img-fluid d-block d-sm-none"
                                width="250" height="30"
                                style="color: var(--tblr-body-color); padding-top: 1.5rem;" />

                                <!-- Teks WiinEx -->
                                {{-- <span class="fw-bold logo-text fs-16" style="color: var(--tblr-body-color);">LymanOps</span> --}}
                            </a>
                    
                            <style>
                                /* Efek hover untuk link */
                                .hover-effect:hover {
                                    opacity: 0.8;
                                    transition: opacity 0.3s ease;
                                }
                    
                                /* Styling untuk logo */
                                .logo-img {
                                    margin-right: 12px; /* Jarak antara logo dan teks */
                                    transition: transform 0.3s ease;
                                }
                    
                                .logo-img:hover {
                                    transform: scale(1.1); /* Efek zoom saat hover */
                                }
                    
                                /* Styling untuk teks WiinEx */
                                .logo-text {
                                    font-size: 1.5rem; /* Ukuran teks lebih besar */
                                    font-weight: bold; /* Tebal */
                                    letter-spacing: 1px; /* Spasi antar huruf */
                                    transition: color 0.3s ease; /* Efek perubahan warna saat hover */
                                }
                    
                                .logo-text:hover {
                                    color: var(--tblr-primary); /* Warna teks berubah saat hover */
                                }
                            </style>
                        </div>
                    
                      <div class="card card-md">
    <div class="card-body">
        <h2 class="h2 text-center mb-4" style="color: #51A49A;">Login to your account</h2>
    
        @if (session()->has('loginError'))
        <div class="alert alert-danger" role="alert" id="error-alert">
            <h4 class="alert-title">Oops! Something went wrong!</h4>
            <div class="text-secondary">{{ session('loginError') }}</div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    const errorAlert = document.getElementById('error-alert');
                    if (errorAlert) {
                        errorAlert.style.transition = 'opacity 0.5s';
                        errorAlert.style.opacity = '0';
                        setTimeout(() => errorAlert.remove(), 500);
                    }
                }, 5000);
            });
        </script>
        @endif
    
        <form action="/login/do" method="post" autocomplete="off">
            @csrf
    
            <div class="mb-3">
                <label class="form-label" style="color: #51A49A;">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="your@email.com" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="mb-2">
                <label class="form-label" style="color: #51A49A;">Password</label>
                <div class="input-group input-group-flat">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Your password">
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
    
            <div class="mb-4">
                <label class="form-check">
                    <input type="checkbox" class="form-check-input" name="remember">
                    <span class="form-check-label" style="color: #51A49A;">Remember me on this device</span>
                </label>
            </div>
    
            <div class="form-footer">
                <button type="submit" class="btn w-100" style="background-color: #51A49A; color: white; border-color: #51A49A;">Sign in</button>
            </div>
        </form>
    </div>
</div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                 
                <img src="{{ asset('logo/DOM.png') }}" class="img d-block mx-auto" style="padding-top: 50px;" height="300" alt="Ilustrasi">


                </div>
            </div>
        </div>
    </div>

    <!-- Libs JS -->
    <script src="/vendor/admin/dist/js/tabler.min.js?1738096682" defer></script>
    <script src="/vendor/admin/dist/js/demo.min.js?1738096682" defer></script>
</body>
</html>