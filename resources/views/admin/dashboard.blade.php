@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-4">Dashboard</h3>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <h5>Users</h5>
          <p>{{ \App\Models\User::count() }}</p>
          <a href="{{ route('users.index') }}" class="btn btn-warning w-100">Manage</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <h5>Categories</h5>
          <p>{{ \App\Models\Category::count() }}</p>
          <a href="{{ route('categories.index') }}" class="btn btn-warning w-100">Manage</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <h5>Videos</h5>
          <p>{{ \App\Models\Video::count() }}</p>
          <a href="{{ route('videos.index') }}" class="btn btn-warning w-100">Manage</a>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3 text-center">
          <h5>Plans</h5>
          <p>{{ \App\Models\Plan::count() }}</p>
          <a href="{{ route('plans.index') }}" class="btn btn-warning w-100">Manage</a>
        </div>
      </div>
    </div>
  </div>
@endsection