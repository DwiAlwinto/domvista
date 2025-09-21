<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Profile | {{ $user->name }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #51A49A;
            --primary-dark: #448c82;
            --bg-light: #f8f9fa;
            --text-muted: #6c757d;
            --card-bg: #ffffff;
            --shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        body {
            background: var(--bg-light);
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #212529;
        }

        /* Cover Image - Full responsive, no cropping */
        .cover-img {
            width: 100%;
            height: auto;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            object-fit: contain;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: opacity 0.4s ease;
        }

        .profile-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: var(--shadow);
            background-color: var(--card-bg);
            position: relative;
            margin-top: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18);
        }

        /* Profile Picture - Floating effect */
        .profile-pic {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            border-radius: 50%;
            margin-top: -60px;
            position: relative;
            z-index: 10;
            transition: transform 0.3s ease;
            border: 3px solid #fff;
        }

        .profile-card:hover .profile-pic {
            transform: scale(1.05);
        }

        /* Name & Role */
        .profile-name {
            font-size: 1.75rem;
            font-weight: 700;
            color: #2c3e50;
            letter-spacing: -0.5px;
            margin: 12px 0 6px 0;
        }

        .badge-custom {
            background: linear-gradient(135deg, var(--primary-color), #3a9d8f);
            color: white;
            font-weight: 600;
            padding: 0.4em 1em;
            border-radius: 50px;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 2px 8px rgba(81, 164, 154, 0.3);
        }

        /* Bio Styling */
        .bio-text {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 600px;
            margin: 20px auto 0;
            padding: 0 20px;
            position: relative;
        }

        .bio-text i {
            color: var(--primary-color);
            opacity: 0.6;
            font-size: 1.1rem;
        }

        /* Back to Home Button */
        .btn-home {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            width: 100%;
            padding: 14px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 6px 16px rgba(81, 164, 154, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 25px;
            border: none;
        }

        .btn-home:hover {
            background: linear-gradient(135deg, var(--primary-dark), #3a7c72);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(81, 164, 154, 0.5);
        }

        /* Subtle animation on load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .profile-container {
            padding: 40px 15px 60px;
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .profile-name {
                font-size: 1.5rem;
            }
            .cover-img {
                height: auto;
            }
            .btn-home {
                font-size: 1rem;
                padding: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container profile-container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Profile Card -->
            <div class="card profile-card border-0 shadow-sm animated">
                
                <!-- Cover Image - Tanpa Crop, Sesuai Rasio Asli -->
                <img 
                    src="{{ $user->foto_profil_url }}" 
                    alt="Cover" 
                    class="cover-img"
                    onerror="this.style.display='none'; document.querySelector('.profile-pic').style.marginTop = '0';">

                <!-- Profile Picture -->
                <img 
                    src="{{ $user->foto_profil_url }}" 
                    alt="Profile" 
                    class="profile-pic mx-auto d-block">

                <!-- User Info -->
                <div class="text-center px-4 pb-3">
                    <h2 class="profile-name">{{ $user->name }}</h2>

                    <span class="badge bg-primary badge-custom">
                        <i class="bi {{ $user->role === 'admin' ? 'bi-shield-fill-check' : ($user->role === 'manager' ? 'bi-person-badge' : 'bi-person') }}"></i>
                        {{ ucfirst($user->role) }}
                    </span>

                    <!-- Bio -->
                    <div class="bio-text mt-3">
                        <i class="bi bi-chat-left-quote"></i>
                        "{{ $user->bio ?? 'Keep learning, keep growing, and never stop upgrading your skills' }}"
                        <i class="bi bi-chat-right-quote"></i>
                    </div>
                </div>

                <!-- Back to Home Button -->
                <div class="px-4 pb-4">
                    <a href="{{ url('/') }}" class="btn-home">
                        <i class="bi bi-house-door"></i> 
                        <span>Back to Home</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>