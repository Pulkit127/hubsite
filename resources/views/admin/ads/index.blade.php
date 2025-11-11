@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-warning mb-3">Ad Banners</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('ads.create') }}" class="btn btn-warning">Add New Banner</a>

        <!-- Search Form -->
        <form action="{{ route('ads.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-light">Search</button>
        </form>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Position</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ads as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td>
                    <img src="{{ asset('storage/' . $ad->image) }}" alt="Ad Image" width="120" class="rounded-3 shadow-sm">
                </td>
                <td>{{ $ad->title ?? '—' }}</td>
                <td><span class="badge bg-info text-dark">{{ ucfirst($ad->position) }}</span></td>
                <td>
                    @if($ad->is_active)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('ads.edit', $ad->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('ads.destroy', $ad->id) }}" method="POST" onsubmit="return confirm('Delete this ad?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4 text-muted">No ad banners found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $ads->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection