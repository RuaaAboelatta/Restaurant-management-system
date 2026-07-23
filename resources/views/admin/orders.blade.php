@extends('layout.master')
@section('title', 'Orders')
@section('content')
<div class="container mt-4">
    <h2>Orders</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">No orders yet.</div>
    @else
        <table class="table table-bordered table-striped mt-5 pt-5">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                        <td>
                            @foreach($order->items as $item)
                                {{ $item->menuItem->name ?? $item->item_name ?? 'Item' }} 
                                ({{ $item->quantity }})
                                @if(!$loop->last)<br>@endif
                            @endforeach
                        </td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection