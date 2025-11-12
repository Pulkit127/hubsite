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

    .pagination {
      margin-top: 20px;
      justify-content: center;
    }

    .pagination .page-link {
      background-color: #212529;
      /* dark background */
      border: 1px solid #343a40;
      color: #ffc107;
      /* yellow text */
      border-radius: 6px;
      margin: 0 3px;
      transition: all 0.2s ease-in-out;
    }

    .pagination .page-link:hover {
      background-color: #ffc107;
      color: #000;
      border-color: #ffc107;
    }

    .pagination .page-item.active .page-link {
      background-color: #ffc107 !important;
      border-color: #ffc107 !important;
      color: #000 !important;
      font-weight: 600;
    }

    .pagination .page-item.disabled .page-link {
      background-color: #2c2c2c;
      color: #6c757d;
      border-color: #343a40;
    }

    .anchor-status {
      text-decoration: auto;
      color: unset;
    }
  </style>
</head>

<body>

  <!-- SIDEBAR -->
  <div class="sidebar bg-dark text-light d-flex flex-column p-3" style="min-height: 100vh; width: 250px;">
    <!-- Logo / Title -->
    <div class="mb-4 text-center">
      <h4 class="fw-bold text-warning mb-0">🎬 HUB Admin</h4>
      <small class="text-secondary">Control Panel</small>
    </div>

    <hr class="border-secondary">

    <!-- Main Navigation -->
    <nav class="nav flex-column gap-1">

      <!-- Dashboard -->
      <a href="{{ route('admin.dashboard') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
      </a>

      <div class="text-uppercase text-secondary small mt-3 mb-1 ps-2">Content</div>

      <!-- Users -->
      <a href="{{ route('users.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <i class="bi bi-people-fill me-2"></i> Users
      </a>

      <!-- Categories -->
      <a href="{{ route('categories.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="bi bi-folder-fill me-2"></i> Categories
      </a>

      <!-- Videos -->
      <a href="{{ route('videos.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('videos.*') ? 'active' : '' }}">
        <i class="bi bi-camera-reels-fill me-2"></i> Videos
      </a>

      <!-- Music -->
      <a href="{{ route('music.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('music.*') ? 'active' : '' }}">
        <i class="bi bi-music-note-beamed me-2"></i> Music
      </a>

      <div class="text-uppercase text-secondary small mt-3 mb-1 ps-2">Monetization</div>

      <!-- Plans -->
      <a href="{{ route('plans.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('plans.*') ? 'active' : '' }}">
        <i class="bi bi-credit-card-2-front me-2"></i> Plans
      </a>

      <!-- Ads Banner -->
      <a href="{{ route('ads.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('ads.*') ? 'active' : '' }}">
        <i class="bi bi-megaphone-fill me-2"></i> Ads Banner
      </a>

      <div class="text-uppercase text-secondary small mt-3 mb-1 ps-2">Website</div>

      <!-- Pages -->
      <a href="{{ route('pages.index') }}"
        class="nav-link text-light sidebar-link {{ request()->routeIs('pages.*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text-fill me-2"></i> Pages
      </a>

    </nav>

    <hr class="border-secondary mt-auto">

    <!-- Logout -->
    <a href="{{ route('admin.logout') }}" class="nav-link text-danger sidebar-link text-center fw-semibold">
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