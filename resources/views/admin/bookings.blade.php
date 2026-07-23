@extends('layout.master')
@section('title', 'Bookings')
@section('content')
<div class="container mt-5 pt-5">
    <h2 class="main-heading">Reservations</h2>
    <hr>

    @if($bookings->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Table</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->table->name }}</td>
                        <td>{{ $booking->user->name ?? $booking->guest_name ?? 'Guest' }}</td>
                        <td>{{ $booking->reservation_date }}</td>
                        <td>{{ $booking->reservation_time }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No reservations found.</p>
    @endif
</div>
@endsection