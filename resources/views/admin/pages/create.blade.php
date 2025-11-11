@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <h3 class="text-warning mb-3">Add Page</h3>

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

        <form action="{{route('pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter title" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="contents" class="form-control" rows="3" placeholder="Enter content"></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Save Page</button>
        </form>
    </div>
@endsection