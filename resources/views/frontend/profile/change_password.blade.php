@extends('frontend.layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container py-5" style="background: #0f0f0f; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            {{-- Change Password Card --}}
            <div class="card border-0 shadow-lg rounded-4" style="overflow: hidden; background: #1a1a1a; color: #f8f9fa;">

                {{-- Header --}}
                <div class="card-header text-center py-4" 
                     style="background: linear-gradient(135deg, #ffc107, #e0b800); color: #000;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ffc107&color=000&size=90"
                         class="rounded-circle mb-3 shadow" alt="User Avatar">
                    <h4 class="fw-bold mb-0">{{ Auth::user()->name }}</h4>
                    <small class="text-dark fw-semibold">{{ Auth::user()->email }}</small>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    {{-- Flash Messages --}}
                    @if(session('error'))
                        <div class="alert alert-danger text-center rounded-3">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success text-center rounded-3">{{ session('success') }}</div>
                    @endif

                    {{-- Change Password Form --}}
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-warning">Current Password</label>
                            <input type="password" name="current_password"
                                   class="form-control form-control-lg rounded-3 border-0 text-light"
                                   style="background-color: #2b2b2b;" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-warning">New Password</label>
                            <input type="password" name="new_password"
                                   class="form-control form-control-lg rounded-3 border-0 text-light"
                                   style="background-color: #2b2b2b;" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-warning">Confirm Password</label>
                            <input type="password" name="new_password_confirmation"
                                   class="form-control form-control-lg rounded-3 border-0 text-light"
                                   style="background-color: #2b2b2b;" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" 
                                    class="btn btn-warning btn-lg px-5 fw-semibold shadow-sm rounded-pill">
                                <i class="bi bi-key me-2"></i> Update Password
                            </button>
                        </div>
                    </form>

                    <hr class="border-secondary my-4">

                    <div class="text-center">
                        <a href="{{ route('profile') }}" 
                           class="btn btn-outline-warning btn-lg px-4 fw-semibold rounded-pill shadow-sm">
                            <i class="bi bi-arrow-left me-2"></i> Back to Profile
                        </a>
                    </div>

                </div>
            </div>
            {{-- End Card --}}

        </div>
    </div>
</div>
@endsection
