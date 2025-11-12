@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4" style="min-height: 100vh;">
  <h3 class="text-warning mb-4 fw-semibold">📊 Dashboard Overview</h3>

  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <!-- Stats Cards -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card bg-dark text-center text-white shadow-lg border-0 rounded-4 p-3">
        <h5>Users</h5>
        <h2 class="text-warning">{{ \App\Models\User::count() }}</h2>
        <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm rounded-pill mt-2">Manage</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-dark text-center text-white shadow-lg border-0 rounded-4 p-3">
        <h5>Videos</h5>
        <h2 class="text-warning">{{ \App\Models\Video::count() }}</h2>
        <a href="{{ route('videos.index') }}" class="btn btn-warning btn-sm rounded-pill mt-2">Manage</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-dark text-center text-white shadow-lg border-0 rounded-4 p-3">
        <h5>Music</h5>
        <h2 class="text-warning">{{ \App\Models\Music::count() ?? 0 }}</h2>
        <a href="{{ route('music.index') }}" class="btn btn-warning btn-sm rounded-pill mt-2">Manage</a>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-dark text-center text-white shadow-lg border-0 rounded-4 p-3">
        <h5>Categories</h5>
        <h2 class="text-warning">{{ \App\Models\Category::count() ?? 0 }}</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-warning btn-sm rounded-pill mt-2">Manage</a>
      </div>
    </div>
    <!-- <div class="col-md-3">
      <div class="card bg-dark text-center text-white shadow-lg border-0 rounded-4 p-3">
        <h5>Plans</h5>
        <h2 class="text-warning">{{ \App\Models\Plan::count() }}</h2>
        <a href="{{ route('plans.index') }}" class="btn btn-warning btn-sm rounded-pill mt-2">Manage</a>
      </div>
    </div> -->
  </div>

  <!-- Graphs -->
  <div class="row g-4">
    <!-- User Growth -->
    <div class="col-md-6">
      <div class="card bg-dark shadow-lg border-0 rounded-4 p-3">
        <h5 class="text-warning mb-3 text-center">User Growth (Monthly)</h5>
        <canvas id="userGrowthChart" height="180"></canvas>
      </div>
    </div>

    <!-- Videos Uploaded -->
    <div class="col-md-6">
      <div class="card bg-dark shadow-lg border-0 rounded-4 p-3">
        <h5 class="text-warning mb-3 text-center">Videos Uploaded (Monthly)</h5>
        <canvas id="videoChart" height="180"></canvas>
      </div>
    </div>

    <!-- Music Uploaded -->
    <div class="col-md-6">
      <div class="card bg-dark shadow-lg border-0 rounded-4 p-3">
        <h5 class="text-warning mb-3 text-center">Music Uploaded (Category Share)</h5>
        <canvas id="musicChart" height="180"></canvas>
      </div>
    </div>

    <!-- Plan Distribution -->
    <div class="col-md-6">
      <div class="card bg-dark shadow-lg border-0 rounded-4 p-3">
        <h5 class="text-warning mb-3 text-center">Plan Distribution</h5>
        <canvas id="planChart" height="180"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Smooth global animations
  Chart.defaults.animation.duration = 1800;
  Chart.defaults.animation.easing = 'easeInOutQuart';
  Chart.defaults.color = '#fff';

  // 1️⃣ User Growth Chart
  new Chart(document.getElementById('userGrowthChart'), {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'New Users',
        data: [15, 25, 30, 50, 40, 65],
        borderColor: '#ffca2c',
        backgroundColor: 'rgba(255, 193, 7, 0.2)',
        fill: true,
        tension: 0.4,
        borderWidth: 3,
        pointRadius: 5,
        pointBackgroundColor: '#ffc107'
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: {
            color: '#ffca2c'
          }
        }
      },
      scales: {
        x: {
          ticks: {
            color: '#bbb'
          },
          grid: {
            color: '#222'
          }
        },
        y: {
          ticks: {
            color: '#bbb'
          },
          grid: {
            color: '#222'
          }
        }
      }
    }
  });

  // 2️⃣ Videos Chart
  new Chart(document.getElementById('videoChart'), {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Videos Uploaded',
        data: [10, 20, 18, 25, 30, 45],
        backgroundColor: [
          '#ffc107', '#ffb84d', '#ffa31a', '#ff9900', '#ff8c1a', '#ff751a'
        ],
        borderRadius: 10
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          ticks: {
            color: '#bbb'
          },
          grid: {
            display: false
          }
        },
        y: {
          ticks: {
            color: '#bbb'
          },
          grid: {
            color: '#333'
          }
        }
      }
    }
  });

  // 3️⃣ Music Chart (Pie)
  new Chart(document.getElementById('musicChart'), {
    type: 'pie',
    data: {
      labels: ['Pop', 'Rock', 'Classical', 'Hip-hop', 'Jazz'],
      datasets: [{
        data: [30, 25, 20, 15, 10],
        backgroundColor: ['#ffca2c', '#0dcaf0', '#6610f2', '#dc3545', '#198754']
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#fff'
          }
        }
      }
    }
  });

  // 4️⃣ Plan Chart (Doughnut)
  new Chart(document.getElementById('planChart'), {
    type: 'doughnut',
    data: {
      labels: ['Free', 'Basic', 'Pro', 'Enterprise'],
      datasets: [{
        data: [40, 25, 20, 15],
        backgroundColor: ['#6c757d', '#ffc107', '#0dcaf0', '#198754'],
        hoverOffset: 10
      }]
    },
    options: {
      cutout: '70%',
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#fff'
          }
        }
      }
    }
  });
</script>
@endsection