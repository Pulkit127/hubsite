@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Edit Video</h3>
    @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif
    <form action="{{ route('videos.update', $video->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Video Upload</label>
        <input type="hidden" name="url" value="{{ $video->video_url }}" />
        <input type="file" class="form-control video-file" name="video_url" accept="video/mp4, video/ogg, video/avi">
      </div>
      <video width="600" controls>
        <source src="{{ asset('storage/' . $video->video_url) }}" type="video/mp4">
      </video>
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control">
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $video->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $video->description }}</textarea>
      </div>
      <button type="submit" class="btn btn-warning">Update Video</button>
    </form>
  </div>
@endsection