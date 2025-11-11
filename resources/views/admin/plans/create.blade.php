@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Add Plan</h3>
    @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    <form action="{{ route('plans.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Plan Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter plan name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" class="form-control" placeholder="Enter price" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Duration (days)</label>
        <input type="number" name="duration_days" class="form-control" placeholder="Enter duration in days" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
      </div>
      <button type="submit" class="btn btn-warning">Save Plan</button>
    </form>
  </div>
@endsection