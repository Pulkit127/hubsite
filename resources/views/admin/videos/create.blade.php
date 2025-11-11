@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Add Video</h3>

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

    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control cat">
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Enter title" required>
      </div>
      <div class="mb-3 video-hide">
        <label class="form-label">Video Upload</label>
        <input type="file" class="form-control image-file" name="video_url" accept="video/mp4, video/ogg, video/avi">
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
      </div>
      <button type="submit" class="btn btn-warning">Save Video</button>
    </form>
  </div>
@endsection