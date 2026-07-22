@extends('layout.master')

@section('content')
<div class="container mt-5 pt-5">
    <h1>Add New Menu Item</h1>
    
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="text-dark">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="text-dark">Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="text-dark">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        
        <div class="mb-3">
            <label class="text-dark">Category</label>
            <input type="text" name="category" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="text-dark">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection