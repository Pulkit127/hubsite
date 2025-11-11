@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
  <h3 class="text-warning mb-3">Edit User</h3>

  <form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Password (Leave blank to keep current)</label>
      <input type="password" name="password" class="form-control" placeholder="Enter new password">
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
    </div>
    <button type="submit" class="btn btn-warning">Update User</button>
  </form>
</div>
@endsection
