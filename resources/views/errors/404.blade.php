<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <!-- Tabler CSS -->
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
   
    <style>
        /* Custom Styles */
        .custom-404 {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .custom-404 .empty-header {
            font-size: 8rem;
            font-weight: bold;
            line-height: 1;
            margin-bottom: 1rem;
        }
        .custom-404 .empty-title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .custom-404 .empty-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        .custom-404 .empty-action .btn {
            font-size: 1rem;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .custom-404 .empty-action .btn .icon {
            width: 1.25rem;
            height: 1.25rem;
        }
    </style>
</head>
<body class="custom-404">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="empty">
                <div class="empty-header">404</div>
                <p class="empty-title" style="font-size: 2rem; font-weight: 700; line-height: 1.2; text-transform: uppercase; margin-bottom: 1.5rem;">
                    Oops! Page Not Found
                </p>
                <p class="empty-subtitle">
                    The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
                </p>
                <div class="empty-action">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <script src="/vendor/admin/dist/js/tabler.min.js?1738096682" defer></script>
    <script src="/vendor/admin/dist/js/demo.min.js?1738096682" defer></script>
</body>
</html>