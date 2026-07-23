@extends('layout.master')
@section('title', 'Home')
@section('content')
    <div class='main mb-5'>
        <div class="overlay d-flex align-items-center">
            <div class='w-50 ms-5 text-light'>
                <h1 class="main-heading text-light">Dining Restaurant</h1>
                <p class="my-4 pb-4">
                    Craving an unforgettable night out? here is your new favorite escape.
                    Tucked away on a charming side street, we serve seasonal, artfully crafted dishes in a cozy,
                    candlelit setting. From our silky burrata to our seared scallops, every bite is pure magic. 
                    Pair it with our curated wine list and warm, attentive service that makes you feel like family. 
                    Come for the food, stay for the experience.
                </p>
                <a href="/menu" class='orange-btn btn-hover'>
                    Order Now
                    <i class="fa-solid fa-arrow-right text-light"></i>
                </a>
                <a href="/reservation" class='glass-btn btn-hover'>Book Table</a>
            </div>
        </div>
    </div>
    <div class="time-table d-flex justify-content-between my-5">
        <div class='d-flex flex-wrap dining-hours p-5'>
            <h2 class='w-100 main-heading'>Dining Hours</h2>
            <p>Monday-Thursday</p>
            <p>11:30 <span class="main-heading">AM</span> - 10:00 <span class="main-heading">PM</span></p>
            <p>Friday-Saturday</p>
            <p>11:30 <span class="main-heading">AM</span> - 11:30 <span class="main-heading">PM</span></p>
            <p>Sunday</p>
            <p>10:00 <span class="main-heading">AM</span> - 9:00 <span class="main-heading">PM</span></p>
        </div>
        <div class="bg"></div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @include('layout.footer')

@stop