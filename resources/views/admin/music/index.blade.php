@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="text-warning mb-3">Music</h3>
        <a href="{{ route('music.create') }}" class="btn btn-warning mb-3">Add New Music</a>

        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($music as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords($item->title) }}</td>
                        <td>
                            <a href="{{ route('music.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('music.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this music?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted text-center">No music found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $music->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection