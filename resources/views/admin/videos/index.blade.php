@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Videos</h3>

    <div class="d-flex justify-content-between mb-3">
      <a href="{{ route('videos.create') }}" class="btn btn-warning">Add New Video</a>

      <!-- Search Form -->
      <form action="{{ route('videos.index') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Search by title or category"
          value="{{ request('search') }}">
        <button type="submit" class="btn btn-light">Search</button>
      </form>
    </div>

    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Category</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($videos as $video)
          <tr>
            <td>{{ $video->id }}</td>
            <td>{{ ucwords($video->title) }}</td>
            <td>{{ $video->category?->name ?? 'N/A' }}</td>
            <td>
              <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('videos.destroy', $video->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-muted">No videos found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
      {{ $videos->links('pagination::bootstrap-5') }}
    </div>
  </div>
@endsection