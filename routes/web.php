<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;


Route::get('/', function () {
    return view('layout.home');
});

Route::get('/menu', function () {
    return view('layout.menu');
});

Route::get('/reservation', function () {
    return view('layout.reservation');
});

Route::get('/cart', function () {
    return view('layout.cart');
});

Route::get('/menu', [MenuController::class, 'showItems'])->name('menu.index');

Route::get('/menu/category/{category}', [MenuController::class, 'filterItems'])->name('menu.category');