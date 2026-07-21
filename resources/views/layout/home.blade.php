@extends('layout.master')
@section('title', 'Home')
@section('content')
    <div class='main mb-5'>
        <div class="overlay d-flex align-items-center">
            <div class='w-50 ms-5 text-light'>
                <h2>our restaurant</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius aliquam magnam fugit sint, culpa sequi nesciunt impedit vero repudiandae fugiat unde soluta cum quibusdam quas esse excepturi dolore molestiae voluptatibus!</p>
                <a href="/menu" class='orange-btn'>
                    Order Now
                    <i class="fa-solid fa-arrow-right text-light"></i>
                </a>
                <a href="/reservations" class='glass-btn'>Reserve Table</a>
            </div>
        </div>
    </div>
    <div class="time-table d-flex justify-content-between my-5">
        <div class='d-flex flex-wrap dining-hours p-5'>
            <h2 class='w-100'>Dining Hours</h2>
            <p>Monday-Thursday</p>
            <p>11:30 AM - 10:00 PM</p>
            <p>Friday-Saturday</p>
            <p>11:30 AM - 11:30 PM</p>
            <p>Sunday</p>
            <p>10:00 AM - 9:00 PM</p>
        </div>
        <div class="bg"></div>
    </div>
    @include('layout.footer')

@stop
