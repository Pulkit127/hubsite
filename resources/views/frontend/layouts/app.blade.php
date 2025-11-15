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
        body {
            background-color: #0f0f0f;
            color: #fff;
            overflow-x: hidden;
        }

        /* 🧭 Navbar */
        .navbar {
            z-index: 1100;
            /* always above sidebar */
        }

        /* 🧱 Sidebar */
        .sidebar {
            width: 240px;
            position: fixed;
            top: 0;
            /* start from top */
            left: 0;
            height: 100vh;
            /* full viewport */
            background-color: #1b1b1b;
            overflow-y: auto;
            padding-top: 56px;
            /* space for navbar */
            transition: all 0.3s ease;
            z-index: 1040;
        }

        .sidebar a.nav-link {
            color: #ccc;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.2s;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
        }

        .sidebar a.nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* 📦 Main Content */
        .main-content {
            margin-left: 240px;
            /* space for sidebar */
            padding-top: 56px;
            /* space for navbar */
            padding-left: 1rem;
            padding-right: 1rem;
            transition: all 0.3s ease;
        }

        /* 📱 Mobile Sidebar */
        @media (max-width: 991.98px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding-top: 60px;
                /* mobile navbar height */
            }
        }

        .offcanvas-sidebar {
            background: #1b1b1b;
            color: #fff;
        }

        /* 👤 User Menu */
        .user-menu-wrapper {
            position: relative;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            cursor: pointer;
        }

        .user-dropdown {
            position: absolute;
            right: 0;
            top: 48px;
            background-color: #1f1f1f;
            border-radius: 0.5rem;
            display: none;
            min-width: 180px;
            z-index: 2000;
        }

        .user-menu-wrapper:hover .user-dropdown {
            display: block;
        }

        .user-dropdown a,
        .user-dropdown button {
            color: #fff;
        }

        /* Scrollbar style */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: #444;
            border-radius: 3px;
        }
    </style>
</head>

<body>
    <!-- 🧭 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <!-- Mobile sidebar toggle -->
            <button class="btn btn-dark d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
                <i class="bi bi-list fs-4"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand text-warning fw-bold" href="{{ route('frontend.home') }}">
                {{ env('APP_NAME') }}
            </a>

            <!-- Navbar collapse -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('home') }}">Home</a>
                    </li>
                    @foreach ($pages as $page)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.show', $page->slug) }}">
                            {{ ucwords($page->title) }}
                        </a>
                    </li>
                    @endforeach
                </ul>

                <!-- User Menu -->
                <div class="d-flex align-items-center gap-3">
                    @if (Auth::guard('web')->check())
                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle d-flex align-items-center gap-2" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/user-avatar.jpeg') }}" class="rounded-circle" width="32"
                                height="32" alt="User Avatar">
                            <span class="d-none d-sm-inline fw-semibold">{{ Auth::user()->name ?? 'User' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end bg-dark border-0 shadow">
                            <li>
                                <a class="dropdown-item text-light" href="{{ Route('profile') }}">
                                    <i class="bi bi-person-fill me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-light" href="{{ Route('change.password') }}">
                                    <i class="bi bi-key-fill me-2"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger fw-semibold">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>

                    @else
                    <!-- If not logged in -->
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-warning text-dark fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light fw-semibold">
                            <i class="bi bi-person-plus me-1"></i> Register
                        </a>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <!-- 🧱 Sidebar (Desktop) -->
    <aside class="sidebar d-none d-lg-block">
        <div class="text-center mb-3">
            <img src="{{ asset('/assets/images/hub-logo.jpg') }}" alt="Logo" class="img-fluid rounded-circle mb-2"
                style="width:80px;">
            <h5 class="text-warning">{{ env('APP_NAME') }}</h5>
        </div>

        <h6 class="text-uppercase">Categories</h6>
        <ul class="nav flex-column gap-2">
            @foreach ($categories as $categorie)
            <li class="nav-item">
                @if ($categorie->children->count() > 0)
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#cat-{{ $categorie->id }}">
                    {!! $categorie->font_icon !!} {{ $categorie->name }}
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse ms-3" id="cat-{{ $categorie->id }}">
                    @foreach ($categorie->children as $sub)
                    <a href="{{ $categorie->type === 'music'
                                    ? route('music.subcategory', $sub->id)
                                    : route('videos.subcategory', $sub->id) }}"
                        class="nav-link text-light">
                        {!! $sub->font_icon !!} {{ $sub->name }}
                    </a>
                    @endforeach
                </div>
                @else
                <a href="{{ $categorie->type === 'music'
                            ? route('music.category', $categorie->id)
                            : route('videos.subcategory', $categorie->id) }}"
                    class="nav-link">
                    {!! $categorie->font_icon !!} {{ $categorie->name }}
                </a>
                @endif
            </li>
            @endforeach
        </ul>

        <hr>
        <a href="{{ Route('plans.upgrade') }}" class="btn btn-warning w-100 text-dark fw-bold mt-2">
            Upgrade Plan
        </a>
    </aside>

    <!-- 📲 Offcanvas Sidebar (Mobile) -->
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
                    <a href="{{ $categorie->type === 'music'
                            ? route('music.category', $categorie->id)
                            : route('videos.subcategory', $categorie->id) }}"
                        class="nav-link text-light">
                        {!! $categorie->font_icon !!} {{ $categorie->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- 📦 Main Content -->
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>