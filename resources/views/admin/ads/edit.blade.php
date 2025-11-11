@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-warning mb-3">Edit Ad Banner</h3>
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
    <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ $ad->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="{{ asset('storage/' . $ad->image) }}" width="150" class="rounded mb-3">
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Redirect Link</label>
            <input type="url" name="link" class="form-control" placeholder="https://example.com" value="{{ $ad->link }}">
        </div>

        {{-- Position --}}
        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="number" name="position" class="form-control" value="{{ $ad->position }}">
        </div>
        <button type="submit" class="btn btn-warning">Update ads</button>
    </form>
</div>
@endsection