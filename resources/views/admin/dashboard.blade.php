@extends('layout.master')

@section('content')
<div class="container pt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="main-heading">Dashboard</h2>
        <a href="{{ route('admin.create') }}" class="btn btn-success my-5">Add New Item</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menuItems as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 5px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>{{ $item->name }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>{{ $item->category }}</td>
                <td>
                    <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.delete', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection