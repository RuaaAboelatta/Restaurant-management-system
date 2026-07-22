@extends('layout.master')

@section('content')
<div class="container mt-5 py-5">
    <h1>Edit Menu Item</h1>
    
    <form action="{{ route('admin.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $menuItem->name }}" required>
        </div>
        
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $menuItem->price }}" required>
        </div>
        
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $menuItem->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control" value="{{ $menuItem->category }}">
        </div>
        
        <div class="mb-3">
            <label>Current Image</label>
            @if($menuItem->image)
                <div class="mb-2">
                    <img src="{{ asset($menuItem->image) }}" width="150" height="150" style="object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                </div>
            @else
                <p class="text-muted">No image uploaded</p>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="text-muted">Leave empty to keep current image</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection