@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-warning mb-3">Add New Ad Banner</h3>
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
    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Redirect Link</label>
            <input type="url" name="link" class="form-control" placeholder="https://example.com">
        </div>

        {{-- Position --}}
        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="number" name="position" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">Save ads</button>
    </form>
</div>
@endsection