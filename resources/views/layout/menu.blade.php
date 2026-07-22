@extends('layout.master')
@section('title', 'menu')
@section('content')
<!DOCTYPE html>
<html>
<head>
</head>
<body class='pt-5'>
    <div class="container-fluid py-5 d-flex">
        <div class="category-container p-5">
            <h3>CATEGORIES</h3>
            <ul class='list-unstyled'>
                <li class="{{ request()->route('category') == 'all' ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i>
                    <a href="{{ route('menu.category', 'all') }}">All</a>
                </li>
                <li class="{{ request()->route('category') == 'appetizers'? 'active' : '' }}">
                    <i class="fa-solid fa-cheese"></i>
                    <a href="{{ route('menu.category', 'appetizers') }}">Appetizers</a>
                </li>
                <li class="{{ request()->route('category') == 'mains'? 'active' : '' }}">
                    <i class="fa-solid fa-drumstick-bite"></i>
                    <a href="{{ route('menu.category', 'mains') }}">Main Course</a>
                </li>
                <li class="{{ request()->route('category') == 'desserts'? 'active' : '' }}">
                    <i class="fa-solid fa-cake-candles"></i>
                    <a href="{{ route('menu.category', 'desserts') }}">Desserts</a>
                </li>
                <li class="{{ request()->route('category') == 'drinks'? 'active' : '' }}">
                    <i class="fa-solid fa-glass-water"></i>
                    <a href="{{ route('menu.category', 'drinks') }}">Drinks</a>
                </li>
            </ul>
        </div>
        
        @if($items->isEmpty())
            <p>No items found.</p>
        @else

            <div class="items-container d-flex flex-wrap justify-content-between py-5">
                @foreach($items as $item)
                    <div class="item-card border">
                        <img src="{{ asset($item->image) }}" alt="#">
                        <div class="card-body p-3">
                            <div class='d-flex justify-content-between'>
                                <h3 class=''>{{ $item->name }}</h3>
                                <p class="price pt-2">${{ number_format($item->price, 2) }}</p>
                            </div>
                            <p>{{ $item->description }}</p>
                           
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                            <button class='add-btn'>
                                <i class="fa-solid fa-plus text-light"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
            
        @endif
    </div>
</body>
</html>
@stop