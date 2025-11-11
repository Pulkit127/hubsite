@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="text-warning mb-3">Edit Music</h3>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('music.update', $music->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Important for update --}}

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $category->id == $music->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" 
                   value="{{ old('title', $music->title) }}" placeholder="Enter title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Music Upload</label>
            <input type="file" class="form-control music-file" name="music_file" accept="audio/mp3,audio/wav,audio/ogg">
            @if($music->music_file)
                <small>Current file: {{ $music->music_file }}</small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" 
                      placeholder="Enter description">{{ old('description', $music->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update Music</button>
        <a href="{{ route('music.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
