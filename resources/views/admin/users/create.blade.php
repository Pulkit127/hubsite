@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
  <h3 class="text-warning mb-3">Add User</h3>

  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter user name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" placeholder="Enter user email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter password" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
    </div>
    <button type="submit" class="btn btn-warning">Save User</button>
  </form>
</div>
@endsection
