<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #0f1720;
            /* slightly bluish black */
            --sidebar-weak: #13181c;
            --muted: #bfc8cf;
            --accent: #f6c84c;
            /* warm yellow */
        }

        html,
        body {
            height: 100%;
        }

        body {
            background-color: #070708;
            color: #e6eef2;
            overflow-x: hidden;
        }

        /* ---------- NAVBAR ---------- */
        .navbar {
            z-index: 1100;
        }

        /* ---------- SIDEBAR ---------- */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg), var(--sidebar-weak));
            color: var(--muted);
            overflow-y: auto;
            padding-top: 56px;
            transition: transform .25s ease, box-shadow .25s ease;
            box-shadow: 0 6px 18px rgba(2, 6, 23, .6);
            border-right: 1px solid rgba(255, 255, 255, 0.03);
            z-index: 1040;
        }

        .sidebar .brand {
            padding: 1rem .75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }

        .sidebar img.logo {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 14px;
        }

        .sidebar h5 {
            color: var(--accent);
            margin-bottom: 0;
        }

        .sidebar h6.section-title {
            font-size: 12px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.22);
            padding: .8rem .75rem .25rem;
            margin-bottom: 0;
            text-align: center;
            /* centered now */
        }

        .sidebar .nav-link {
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            /* CENTERED CONTENT */
            gap: .6rem;
            padding: .5rem .75rem;
            border-radius: 8px;
            transition: background .15s ease, transform .08s ease, color .12s ease;
            font-weight: 500;
            text-align: center;
            /* text center */
        }

        .sidebar .nav-link i {
            font-size: 1.05rem;
            opacity: .95;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.03);
            color: #fff;
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, rgba(246, 200, 76, 0.12), rgba(246, 200, 76, 0.04));
            color: #fff;
            box-shadow: inset 3px 0 0 var(--accent);
        }

        /* Collapsible submenu */
        .sidebar .collapse .nav-link {
            padding-left: 1.6rem;
            font-weight: 400;
            font-size: .95rem;
        }

        .chev {
            margin-left: auto;
            transition: transform .18s ease;
            color: rgba(255, 255, 255, 0.35);
        }

        .chev.rotate {
            transform: rotate(180deg);
            color: rgba(255, 255, 255, 0.8);
        }

        /* make sure sidebar scrollbar is subtle */
        .sidebar::-webkit-scrollbar {
            width: 7px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 6px;
        }

        /* ---------- MAIN CONTENT ---------- */
        .main-content {
            margin-left: 260px;
            padding-top: 56px;
            padding-left: 1rem;
            padding-right: 1rem;
            transition: margin .25s ease;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-120%);
            }

            .sidebar.show-mobile {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-top: 72px;
            }
        }

        /* small user dropdown tweak */
        .dropdown-menu.bg-dark {
            background: linear-gradient(180deg, #0b0b0b, #141414);
            border-radius: .6rem;
        }

        .text-muted {
            --bs-text-opacity: 1;
            color: rgb(249 249 249 / 75%) !important;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <!-- Mobile sidebar toggle -->
            <button id="mobileToggle" class="btn btn-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand text-warning fw-bold" href="{{ route('frontend.home') }}">
                {{ env('APP_NAME') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="{{ Route('home') }}">Home</a></li>
                    @foreach ($pages as $page)
                    <li class="nav-item"><a class="nav-link" href="{{ route('page.show', $page->slug) }}">{{ ucwords($page->title) }}</a></li>
                    @endforeach
                </ul>
                <!-- User Menu -->
                <div class="d-flex align-items-center gap-3">
                    @if (Auth::guard('web')->check())
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger fw-semibold"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                    </form>
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle d-flex align-items-center gap-2" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/user-avatar.jpeg') }}" class="rounded-circle" width="32" height="32" alt="User Avatar">
                            <span class="d-none d-sm-inline fw-semibold">{{ Auth::user()->name ?? 'User' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-0 shadow">
                            <li><a class="dropdown-item text-light" href="{{ Route('profile') }}"><i class="bi bi-person-fill me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item text-light" href="{{ Route('change.password') }}"><i class="bi bi-key-fill me-2"></i> Change Password</a></li>
                        </ul>
                    </div>
                    @else
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-warning text-dark fw-semibold"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light fw-semibold"><i class="bi bi-person-plus me-1"></i> Register</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR (Desktop) -->
    <aside class="sidebar d-none d-lg-block" id="desktopSidebar">
        <div class="brand text-center p-3">
            <img src="{{ asset('/assets/images/hub-logo.jpg') }}" alt="Logo" class="logo mb-2">
            <h5 class="text-warning">{{ env('APP_NAME') }}</h5>
            <div class="small text-muted">Discover music & videos</div>
        </div>

        <h6 class="section-title">Categories</h6>
        <ul class="nav flex-column p-2 gap-2 mb-2">
            @foreach ($categories as $categorie)
            <li class="nav-item">
                @if ($categorie->children->count() > 0)
                <a class="nav-link d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#cat-{{ $categorie->id }}" role="button" aria-expanded="false" aria-controls="cat-{{ $categorie->id }}">
                    <span>{!! $categorie->font_icon !!}</span>
                    <span class="ms-1">{{ $categorie->name }}</span>
                    <i class="bi bi-chevron-down chev ms-auto"></i>
                </a>
                <div class="collapse ms-2" id="cat-{{ $categorie->id }}">
                    @foreach ($categorie->children as $sub)
                    <a href="{{ $categorie->type === 'music' ? route('music.subcategory', $sub->id) : route('videos.subcategory', $sub->id) }}" class="nav-link text-light">{!! $sub->font_icon !!} {{ $sub->name }}</a>
                    @endforeach
                </div>
                @else
                <a href="{{ $categorie->type === 'music' ? route('music.category', $categorie->id) : route('videos.subcategory', $categorie->id) }}" class="nav-link">{!! $categorie->font_icon !!} {{ $categorie->name }}</a>
                @endif
            </li>
            @endforeach
        </ul>

        <div class="p-3">
            <a href="{{ Route('plans.upgrade') }}" class="btn btn-warning w-100 text-dark fw-bold">Upgrade Plan</a>
        </div>

        <div class="mt-auto p-3 small text-muted">© {{ date('Y') }} {{ env('APP_NAME') }}</div>
    </aside>

    <!-- OFFCANVAS SIDEBAR (Mobile) -->
    <div class="offcanvas offcanvas-start offcanvas-sidebar" tabindex="-1" id="mobileSidebar">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title text-warning">{{ env('APP_NAME') }}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <h6>Categories</h6>
            <ul class="nav flex-column">
                @foreach ($categories as $categorie)
                <li class="nav-item mb-1">
                    <a href="{{ $categorie->type === 'music' ? route('music.category', $categorie->id) : route('videos.subcategory', $categorie->id) }}" class="nav-link" style="--bs-text-opacity: 1;">{!! $categorie->font_icon !!} {{ $categorie->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // close mobile offcanvas when a link is clicked (better UX)
        document.querySelectorAll('.offcanvas .nav-link').forEach(function(a) {
            a.addEventListener('click', function() {
                const off = document.getElementById('mobileSidebar');
                const bs = bootstrap.Offcanvas.getInstance(off);
                if (bs) bs.hide();
            })
        });

        // small accessibility: focus visible state for sidebar links
        document.querySelectorAll('.sidebar .nav-link').forEach(function(link) {
            link.addEventListener('focus', function() {
                this.style.outline = '2px solid rgba(246,200,76,0.18)';
            });
            link.addEventListener('blur', function() {
                this.style.outline = '';
            });
        });
    </script>
</body>

</html>