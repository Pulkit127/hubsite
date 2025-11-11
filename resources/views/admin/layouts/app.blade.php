<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel | HUB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <style>
    body {
      background-color: #121212;
      color: #fff;
      font-family: "Poppins", sans-serif;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      background-color: #1e1e2d;
      transition: all 0.3s ease;
      z-index: 1000;
    }

    .sidebar .nav-link {
      padding: 10px 15px;
      border-radius: 8px;
      font-weight: 500;
      display: flex;
      align-items: center;
    }

    .sidebar .nav-link:hover {
      background-color: #2c2c3e;
      color: #ffc107;
      text-decoration: none;
    }

    .sidebar .nav-link.active {
      background-color: #34344e;
      color: #ffc107;
    }

    .sidebar hr {
      border-color: rgba(255, 255, 255, 0.1);
    }

    .main-content {
      margin-left: 220px;
      padding: 20px;
    }

    .navbar {
      background-color: #1e1e1e;
      border-bottom: 2px solid #f1c40f;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .btn-warning {
      color: #121212;
      font-weight: 600;
    }

    table {
      background-color: #1e1e1e;
      color: #fff;
    }

    table th,
    table td {
      vertical-align: middle;
    }

    input,
    select {
      background-color: #2b2b2b;
      color: #fff;
      border: 1px solid #555;
    }

    .sidebar .nav-link.active {
      background-color: #34344e;
      color: #ffc107 !important;
      border-radius: 8px;
    }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <div class="sidebar bg-dark text-light d-flex flex-column p-3" style="min-height: 100vh; width: 250px;">
    <div class="mb-4 text-center">
      <h4 class="fw-bold text-warning mb-0">🎬 HUB Admin</h4>
      <small class="text-secondary">Control Panel</small>
    </div>

    <hr class="border-secondary">

    <nav class="nav flex-column gap-2">
      <a href="{{ route('admin.dashboard') }}"
        class="nav-link text-light sidebar-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
      </a>

      <a href="{{ route('users.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'users.') ? 'active' : '' }}">
        <i class="bi bi-people me-2"></i> Users
      </a>

      <a href="{{ route('categories.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'categories.') ? 'active' : '' }}">
        <i class="bi bi-folder me-2"></i> Categories
      </a>

      <a href="{{ route('music.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'musics.') ? 'active' : '' }}">
        <i class="bi bi-music-note me-2"></i> Music
      </a>

      <a href="{{ route('videos.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'videos.') ? 'active' : '' }}">
        <i class="bi bi-camera-reels me-2"></i> Videos
      </a>

      <a href="{{ route('ads.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'ads.') ? 'active' : '' }}">
        <i class="bi bi-credit-card me-2"></i> Ads Banner
      </a>

      <a href="{{ route('plans.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'plans.') ? 'active' : '' }}">
        <i class="bi bi-credit-card me-2"></i> Plans
      </a>

      <a href="{{ route('pages.index') }}"
        class="nav-link text-light sidebar-link {{ Str::startsWith(Route::currentRouteName(), 'pages.') ? 'active' : '' }}">
        <i class="bi bi-credit-card me-2"></i> Pages
      </a>

    </nav>

    <hr class="border-secondary mt-auto">

    <a href="{{ route('admin.logout') }}" class="nav-link text-danger sidebar-link text-center">
      <i class="bi bi-box-arrow-right me-2"></i> Logout
    </a>
  </div>

  <!-- MAIN CONTENT -->
  <div class="main-content" style="margin-left: 250px; padding: 20px;">
    <nav class="navbar px-3">
      <span class="fs-5 fw-semibold text-warning">Admin Panel</span>
    </nav>

    @yield('content')

  </div>

</body>

</html>