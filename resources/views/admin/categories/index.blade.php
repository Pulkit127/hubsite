@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Categories</h3>

    <div class="d-flex justify-content-between mb-3">
      <a href="{{ route('categories.create') }}" class="btn btn-warning">Add New Category</a>

      <!-- Search Form -->
      <form action="{{ route('categories.index') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
          value="{{ request('search') }}">
        <button type="submit" class="btn btn-light">Search</button>
      </form>
    </div>

    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Font Icon</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ ucwords($category->name) }}</td>
            <td>{!! $category->font_icon !!}</td>
            <td>
              <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-muted text-center">No categories found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
      {{ $categories->links('pagination::bootstrap-5') }}
    </div>
  </div>
@endsection