@extends('frontend.layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="container py-5" style="background-color: #111; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            {{-- Profile Card --}}
            <div class="card border-0 shadow-lg rounded-4" style="background-color: #1c1c1c; color: #f8f9fa;">
                
                {{-- Header --}}
                <div class="card-header text-center py-4" 
                     style="background: linear-gradient(135deg, #FFD700, #ffcc00); color: #000;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=FFD700&color=000&size=90"
                         class="rounded-circle mb-3 border border-dark shadow" alt="User Avatar">
                    <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                    <small class="opacity-75">{{ $user->email }}</small>
                </div>

                {{-- Body --}}
                <div class="card-body p-4">

                    {{-- Success & Error Messages --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center rounded-3 bg-dark border border-success text-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger rounded-3 bg-dark border border-danger text-danger">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Update Profile Form --}}
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-warning">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                   class="form-control form-control-lg rounded-3 border-0 text-light"
                                   style="background-color: #2a2a2a;" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-warning">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="form-control form-control-lg rounded-3 border-0 text-light"
                                   style="background-color: #2a2a2a;" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" 
                                    class="btn btn-lg px-5 rounded-pill fw-semibold"
                                    style="background-color: #FFD700; color: #000; border: none;">
                                <i class="bi bi-save me-2"></i> Update Profile
                            </button>
                        </div>
                    </form>

                    <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.2);">

                    {{-- Change Password --}}
                    <div class="text-center">
                        <a href="{{ route('change.password') }}" 
                           class="btn btn-outline-warning btn-lg px-4 rounded-pill fw-semibold">
                            <i class="bi bi-key me-2"></i> Change Password
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
