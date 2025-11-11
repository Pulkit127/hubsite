@extends('frontend.plans.app')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bold text-warning">Choose Your Perfect Plan</h1>
    <p class="text-secondary mt-2">Upgrade anytime and unlock premium video access, downloads, and ad-free experience.</p>
  </div>

  <!-- Alerts -->
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @elseif(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  <div class="row g-4 justify-content-center">
    @foreach($plans as $plan)
    <div class="col-md-4">
      <div class="card bg-gradient border-0 text-light shadow-lg h-100 position-relative plan-card"
        style="background: linear-gradient(160deg, #1b1b1b, #0d0d0d); transition: 0.3s ease;">

        @if($plan->is_popular ?? false)
        <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 rounded-bottom-start fw-bold small shadow">
          Most Popular
        </div>
        @endif

        <div class="card-body d-flex flex-column text-center px-4">
          <h4 class="fw-bold mb-2">{{ $plan->name }}</h4>
          <h2 class="text-warning fw-bold mb-3">₹{{ $plan->price }}</h2>
          <p class="text-secondary mb-4">{{ $plan->description }}</p>

          @if($plan->features)
          <ul class="list-unstyled text-start mx-auto mb-4" style="max-width: 250px;">
            @foreach($plan->features as $feature)
            <li class="d-flex align-items-start mb-2">
              <i class="bi bi-check-circle-fill text-warning me-2"></i>
              <span>{{ $feature }}</span>
            </li>
            @endforeach
          </ul>
          @endif

          <form action="{{ route('plans.upgrade.submit', $plan->id) }}" method="POST" class="mt-auto">
            @csrf
            <button type="submit" class="btn btn-warning text-dark fw-semibold w-100 py-2 rounded-pill shadow-sm hover-grow">
              Upgrade Now
            </button>
          </form>
        </div>

        <div class="card-footer text-center bg-transparent border-0 text-muted small py-3">
          <i class="bi bi-shield-lock-fill me-1"></i> 100% Secure Payment
        </div>
      </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mb-4">
      <a href="{{ route('frontend.home') }}" class="btn btn-outline-warning btn-sm px-4">
        <i class="bi bi-arrow-left"></i> Back to Home
      </a>
    </div>
  </div>
</div>

<!-- Custom Hover Animation -->
<style>
  .plan-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 0 25px rgba(255, 193, 7, 0.25);
  }

  .hover-grow:hover {
    transform: scale(1.03);
  }
</style>
@endsection