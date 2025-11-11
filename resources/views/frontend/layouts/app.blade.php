<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark'=> ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ url('assets/style.css') }}" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ps-3">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="#">{{ env('APP_NAME') }}</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ Route('frontend.home') }}">Home</a>
                    </li>
                    @foreach ($pages as $page)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.show', $page->slug) }}">{{ ucwords($page->title) }}</a>
                    </li>
                    @endforeach
                </ul>
                <!-- 
                <form class="d-flex me-3" role="search">
                    <input class="form-control form-control-sm" type="search" placeholder="🔍 Search videos..."
                        aria-label="Search">
                </form> -->

                <div class="user-menu-wrapper position-relative">
                    @if(Auth::guard('web')->check())
                    <img src="{{ asset('assets/images/user-avatar.jpeg') }}" class="rounded-circle user-avatar"
                        alt="User Avatar" id="userAvatarNav">
                    <div class="user-dropdown bg-dark text-light shadow rounded-3">
                        <a href="{{ Route('profile') }}" class="dropdown-item">
                            <i class="bi bi-person-fill me-2"></i> Profile
                        </a>
                        <a href="{{ Route('change.password') }}" class="dropdown-item">
                            <i class="bi bi-key-fill me-2"></i> Change Password
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-warning fw-semibold text-dark">
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

    <hr />

    <!-- Sidebar -->
    <div class="sidebar bg-dark text-light vh-100 p-3 position-fixed" style="width: 220px;">
        <!-- Logo -->
        <div class="sidebar-logo mb-4 text-center">
            <img src="http://127.0.0.1:8000/assets/images/hub-logo.jpg" alt="Logo" class="img-fluid rounded-circle mb-2"
                style="width:80px;">
            <h5 class="text-warning">{{ env('APP_NAME') }}</h5>
        </div>
        <hr>

        <!-- Categories -->
        <ul class="nav flex-column gap-2">
            <h5>Categories</h5>
            <ul class="nav flex-column">
                @foreach($categories as $categorie)
                <li class="nav-item">

                    @if($categorie->children->count() > 0)
                    {{-- 🌳 Main category with dropdown --}}
                    <a class="nav-link text-light d-flex align-items-center gap-2 sidebar-item"
                        data-bs-toggle="collapse"
                        href="#cat-{{ $categorie->id }}"
                        role="button"
                        aria-expanded="false"
                        aria-controls="cat-{{ $categorie->id }}">
                        {!! $categorie->font_icon !!} {{ $categorie->name ?? '' }}
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </a>

                    {{-- Subcategories --}}
                    <div class="collapse ms-3" id="cat-{{ $categorie->id }}">
                        <ul class="nav flex-column">
                            @foreach($categorie->children as $sub)
                            <li class="nav-item">
                                @if($categorie->type === "music")
                                <a href="{{ route('music.subcategory', $sub->id) }}"
                                    class="nav-link text-light d-flex align-items-center gap-2 sidebar-item">
                                    {!! $sub->font_icon !!} {{ $sub->name ?? '' }}
                                </a>
                                @else
                                <a href="{{ route('videos.subcategory', $sub->id) }}"
                                    class="nav-link text-light d-flex align-items-center gap-2 sidebar-item">
                                    {!! $sub->font_icon !!} {{ $sub->name ?? '' }}
                                </a>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @else
                    {{-- 🟢 Main category without subcategories (clickable) --}}
                    <a href="{{ $categorie->type === "music" ? route('music.category', $categorie->id) : route('videos.subcategory', $categorie->id) }}"
                        class="nav-link text-light d-flex align-items-center gap-2 sidebar-item">
                        {!! $categorie->font_icon !!} {{ $categorie->name ?? '' }}
                    </a>
                    @endif

                </li>
                @endforeach
            </ul>

            <hr />
            <li class="nav-item mt-3">
                <a href="{{ Route('plans.upgrade') }}" class="btn btn-warning w-100 text-dark fw-bold">
                    Upgrade Plan
                </a>
            </li>
        </ul>
    </div>

    @yield('content')

    <!-- JS to Change Main Video -->
    <script src="{{  url('assets/app.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>