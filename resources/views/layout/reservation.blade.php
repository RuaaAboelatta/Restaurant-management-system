@extends('layout.master')
@section('title', 'reservation')
@section('content')
    <div class="container d-flex justify-content-between align-items-center">
        <div class="reservation">
            <form action="{{ route('reservations.store') }}" method="POST" class="mt-5 p-5 form-bg">
                @csrf
                
                <div class="form-group mt-3">
                    <label for="table_id">Select Table:</label>
                    <select class="form-control p-2" id="table_id" name="table_id" required>
                        <option value="">Select a table</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}" {{ old('table_id') == $table->id ? 'selected' : '' }}>
                                Table {{ $table->id }}
                            </option>
                        @endforeach
                    </select>
                    @error('table_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group mt-3">
                    <label for="reservation_date">Select Date:</label>
                    <input type="date" class="form-control p-2" id="reservation_date" name="reservation_date" value="{{ old('reservation_date') }}" required min="{{ date('Y-m-d') }}">
                    @error('reservation_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <div class="form-group mt-3">
                    <label for="reservation_time">Select Time:</label>
                    <input type="time" class="form-control p-2" id="reservation_time" name="reservation_time" value="{{ old('reservation_time') }}" required>
                    @error('reservation_time')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                <button type="submit" class="glass-btn mt-4 btn-hover">Submit</button>
            </form>
            
            @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        
        <div class="table-layout mt-5 pt-5">
            <img src="{{ asset('images/table_layout.png') }}" alt="table-layout" class="w-100 h-100">
        </div>
    </div>
@stop