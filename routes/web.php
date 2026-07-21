<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.home');
});

// Route::get('/home', function () {
//     return view('layout.home');
// });

Route::get('/menu', function () {
    return view('layout.menu');
});

Route::get('/reservation', function () {
    return view('layout.reservation');
});

Route::get('/cart', function () {
    return view('layout.cart');
});
