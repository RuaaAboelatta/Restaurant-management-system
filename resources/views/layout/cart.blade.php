@extends('layout.master')
@section('title', 'Cart')
@section('content')
    
<div class="container pt-5 mt-5">
    <h2 class="mb-4 main-heading">Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(empty($cart))
        <div class="d-flex justify-content-between py-5">
            <h4 class="mb-4">Your cart is empty</h4>
            <a href="/menu" class="orange-btn">Browse Menu</a>
        </div>
    @else
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        @foreach($cart as $id => $item)
                            <div class="row py-3 border-bottom align-items-center order-row">
                                <div class="col-1">
                                    <span class="text-muted">{{ $loop->iteration }}</span>
                                </div>
                                <div class="col-4">
                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                    <small class="text-muted">${{ number_format($item['price'], 2) }}</small>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                               min="1" class="form-control form-control-sm text-center" 
                                               style="width: 60px;" onchange="this.form.submit()">
                                    </form>
                                </div>
                                <div class="col-2 text-end">
                                    <strong>${{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                                </div>
                                
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                           
                            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" 
                                        onclick="return confirm('Clear cart?')">
                                    <i class="bi bi-trash3"></i> Clear Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Items</span>
                            <span class="badge bg-danger">{{ session('cart_count', 0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <hr>
                        
                        
                    </div>
                </div>
            </div>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <button type="submit" class="orange-btn mt-5" style="float: right;">Checkout</button>
            </form>
        </div>
    @endif
</div>
@stop