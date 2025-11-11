@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Edit Plan</h3>
    @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif
    <form action="{{ route('plans.update', $plan->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Plan Name</label>
        <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" class="form-control" value="{{ $plan->price }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Duration (days)</label>
        <input type="number" name="duration_days" class="form-control" value="{{ $plan->duration_days }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $plan->description }}</textarea>
      </div>
      <button type="submit" class="btn btn-warning">Update Plan</button>
    </form>
  </div>
@endsection