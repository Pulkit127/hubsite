@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-warning mb-3">Pages</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('pages.create') }}" class="btn btn-warning mb-3">Add Page</a>

        <!-- Search Form -->
        <form action="{{ route('pages.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by title"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-light">Search</button>
        </form>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>
                    <a href="{{ route('pages.edit', $page->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this page?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection