@extends('admin.layouts.app')

@section('content')
  <div class="container-fluid">
    <h3 class="text-warning mb-3">Edit Category</h3>
    @if($errors->any())
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label>Parent Category (optional)</label>
        <select name="parent_id" class="form-control">
          <option value="">Main Category</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @if($category->parent_id == $cat->id) selected @endif>{{ $cat->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Category Font Icon</label>
        <input type="text" name="font_icon" class="form-control" placeholder="Enter font icon"
          value="{{ $category->font_icon }}" required>
      </div>
      <button type="submit" class="btn btn-warning">Update Category</button>
    </form>
  </div>
@endsection