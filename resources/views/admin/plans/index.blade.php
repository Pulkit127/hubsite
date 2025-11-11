@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Plans</h3>
    <a href="{{ route('plans.create') }}" class="btn btn-warning mb-3">Add New Plan</a>

    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Duration (days)</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($plans as $plan)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ ucwords($plan->name) }}</td>
            <td>{{ $plan->price }}</td>
            <td>{{ $plan->duration_days }}</td>
            <td>
              <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-muted">No plans found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection