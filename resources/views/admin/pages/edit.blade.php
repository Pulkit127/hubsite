@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <h3 class="text-warning mb-3">Edit Page</h3>

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

        <form action="{{ route('pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="contents" id="content" class="form-control" rows="10"
                    required>{{ old('content', $page->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-warning">Update Page</button>
        </form>
    </div>
@endsection