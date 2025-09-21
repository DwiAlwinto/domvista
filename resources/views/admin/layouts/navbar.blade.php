	<!-- Navbar -->
<div class="sticky-top">
        {{-- Navbar atas --}}
        <header class="navbar navbar-expand-md sticky-top d-print-none" >
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <style>
                        /* Default logo (light mode) */
                            .logo-img {
                                filter: brightness(1); /* Normal */
                                transition: filter 0.3s ease;
                            }

                            /* Glow effect saat dark mode */
                            @media (prefers-color-scheme: dark) {
                                .logo-img {
                                    filter: brightness(1.5) drop-shadow(0 0 6px rgba(255, 255, 255, 0.4));
                                }
                            }

                            /* Efek hover */
                            .hover-effect:hover .logo-img {
                                filter: brightness(1.2);
                            }
                    </style>
                    <a href="{{ url('/home') }}" class="d-flex align-items-center text-decoration-none hover-effect">
                        <img src="{{ asset('logo/DOM-LOGO.png') }}" alt="Windo Logo" class="img-fluid logo-img" width="100" height="" style="color: var(--tblr-body-color);" />
                        {{-- <span class="fw-bold logo-text fs-8" style="color: var(--tblr-body-color);">Domaine</span> --}}
                    </a>
                    
                    <style>
                        .hover-effect:hover {
                            opacity: 0.8;
                            transition: opacity 0.3s ease;
                        }
                        .logo-img {
                            margin-right: 8px;
                            transition: transform 0.3s ease;
                        }
                        .logo-img:hover {
                            transform: scale(1.1);
                        }
                    </style>
                    
                </div>

                                <div class="navbar-nav flex-row order-md-last" >
                                    <div class="nav-item d-none d-md-flex me-3">
                                        <style>
                                            .btn-list .btn {
                                                color: #51A49A !important;
                                                border-color: #51A49A !important;
                                            }
                                            .btn-list .btn:hover, .btn-list .btn:focus {
                                                background-color: #51A49A !important;
                                                color: #fff !important;
                                                border-color: #51A49A !important;
                                            }
                                            .btn-list .btn .icon-love {
                                                stroke: #51A49A !important;
                                            }
                                            .btn-list .btn:hover .icon-love,
                                            .btn-list .btn:focus .icon-love {
                                                stroke: #fff !important;
                                            }
                                        </style>
                                      
                                    </div>

                
                                <div class="d-none d-md-flex ">

                    <div class="nav-item">
                        <style>
                            .green-icon {
                                stroke: #51A49A !important;
                                color: #51A49A !important;
                            }
                        </style>

                        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark btn-success" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#51A49A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1 green-icon">
                                <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                            </svg>
                        </a>
                        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                            data-bs-placement="bottom">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#51A49A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1 green-icon">
                                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                            </svg>
                        </a>
                    </div>
                        

                <div class="nav-item dropdown d-none d-md-flex me-3">
                            <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/bell -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1 green-icon"><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                                <span class="badge bg-red"></span>
                            </a>

                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Last updates</h3>
                                </div>
                                
                                <div class="list-group list-group-flush list-group-hoverable">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                                            <div class="col text-truncate">
                                                <a href="#" class="text-body d-block">Fitur</a>
                                                <div class="d-block text-secondary text-truncate mt-n1">
                                                    This feature will be updated next (#29604)
                                                </div>
                                            </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <!-- Download SVG icon from http://tabler.io/icons/icon/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon text-muted icon-2"><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                
            </div>

                <div class="nav-item dropdown ms-2" >
                    <a href="#" class="nav-link d-flex align-items-center text-reset p-0" data-bs-toggle="dropdown">
                        <span class="avatar avatar-lg me-2"
                            style="background-image: url({{ asset('storage/' . auth()->user()->foto_profil) }});
                                    width: 48px;
                                    height: 48px;
                                    background-size: cover;
                                    background-position: center;
                                    box-shadow: 0 2px 8px rgba(81, 164, 154, 0.15);">
                        </span>
                        <div class="d-none d-xl-block text-end">
                            <div style="color: #51A49A; font-weight: 600;">{{ auth()->user()->name }}</div>
                            <div class="mt-1 small" style="color: #51A49A;">Casa Domaine</div>
                        </div>
                    </a>

                <style>
                    .avatar {
                        transition: all 0.2s ease-in-out;
                        border: 2px solid transparent;
                    }

                    .avatar:hover {
                        transform: scale(1.05);
                        box-shadow: 0 4px 12px rgba(81, 164, 154, 0.2);
                    }

                    .nav-link:hover .avatar {
                        border-color: #51A49A;
                    }
                </style>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                             <a href="{{ route('profile.show') }}" class="dropdown-item" style="color: #51A49A;">
                                <i class="fas fa-user me-1"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                                <a href="/logout" class="dropdown-item" style="color: #51A49A;">Logout</a>
                            </div>
                        </div>
                </div>
         </header>
        {{-- Navbar atas --}}

        {{-- navbar bawah --}}
        <header class="navbar-expand-md">
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <div class="navbar">
                            <div class="container-xl">
                                <div class="row flex-fill align-items-center">
                                    <div class="col">
                <ul class="navbar-nav">

                    <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/dashboard">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item {{ Request::is('admin/wo/list*') ? 'active' : '' }}">
                        <a class="nav-link" href="/admin/wo/list">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-autofit-content"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4l-3 3l3 3" /><path d="M18 4l3 3l-3 3" /><path d="M4 14m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M10 7h-7" /><path d="M21 7h-7" /></svg>
                            </span>
                            <span class="nav-link-title">Work Order Schedule</span>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('admin.logbook.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.logbook.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-vocabulary">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M10 19h-6a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1h6a2 2 0 0 1 2 2a2 2 0 0 1 2 -2h6a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-6a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2z" />
                                    <path d="M12 5v16" />
                                    <path d="M7 7h1" />
                                    <path d="M7 11h1" />
                                    <path d="M16 7h1" />
                                    <path d="M16 11h1" />
                                    <path d="M16 15h1" />
                                </svg>
                            </span>
                            <span class="nav-link-title">Digital Logbook</span>
                        </a>
                    </li>

                        


                <li class="nav-item dropdown {{ request()->is('admin/master/residents*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Ikon Database -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                                <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Resident Database
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->is('admin/master/residents*') ? 'active' : '' }}" href="{{ route('admin.master.residents.index') }}">
                                    Resident Data
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                                    
                    @can('view-user-data')
                        <li class="nav-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                            <a class="nav-link" href="/admin/user">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                                        <path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
                                    </svg>
                                </span>
                                <span class="nav-link-title">
                                    Data User
                                </span>
                            </a>
                        </li>
                    @endcan
                </ul>
                        </div>
                    </div>

                
                                
                        </div>
                    </div>
        </header>
         {{-- navbar bawah --}}
</div>
    <!-- Navbar -->
    <style>
        /* Active nav item styling */
        .nav-item.active .nav-link {
            color: #fff !important;
            background: linear-gradient(90deg, #51A49A 0%, #3C8DBC 100%);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(81, 164, 154, 0.08);
            font-weight: 600;
            transition: background 0.3s, color 0.3s;
        }
        .nav-item.active .nav-link .icon {
            color: #fff !important;
            filter: drop-shadow(0 2px 4px rgba(81, 164, 154, 0.15));
            transition: color 0.3s;
        }
        /* Hover effect for nav links */
        .nav-link {
            border-radius: 8px;
            transition: background 0.3s, color 0.3s;
        }
        .nav-link:hover, .nav-link:focus {
            background: rgba(81, 164, 154, 0.08);
            color: #51A49A !important;
        }
        .nav-link .icon {
            transition: color 0.3s, transform 0.3s;
        }
        .nav-link:hover .icon, .nav-link:focus .icon {
            color: #51A49A !important;
            transform: scale(1.08);
        }
        /* Dropdown menu styling */
        .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 24px rgba(60, 141, 188, 0.10);
            border: none;
            padding: 0.5rem 0;
        }
        .dropdown-item {
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }
        .dropdown-item.active, .dropdown-item:active, .dropdown-item:hover {
            background: linear-gradient(90deg, #51A49A 0%, #3C8DBC 100%);
            color: #fff !important;
        }
        /* Avatar border for user */
        .avatar-md {
            box-shadow: 0 2px 8px rgba(81, 164, 154, 0.10);
        }
    </style>