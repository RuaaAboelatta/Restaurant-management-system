<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReservationController;


// NAVIGATION
Route::get('/', function () {
    return view('layout.home');
});
Route::get('/menu', function () {
    return view('layout.menu');
});
Route::get('/reservation', function () {
    return view('layout.reservation');
});

// CART
Route::get('/cart',[CartController::class, 'showCart'])->name('cart.index');
Route::post('/cart/add',[CartController::class, 'addToCart'])->name('cart.add');
Route::put('/cart/update/{id}',[CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}',[CartController::class, 'removeFromCart'])->name('cart.remove');
Route::delete('/cart/clear',[CartController::class, 'clearCart'])->name('cart.clear');

Route::get('/order', function () {
    return view('layout.order');
})->middleware('auth');
Route::get('/menu', [MenuController::class, 'showItems'])->name('menu.index');
Route::get('/menu/category/{category}', [MenuController::class, 'filterItems'])->name('menu.category');


// AUTHINTICATION
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    
});
Route::middleware('auth')->controller(ReservationController::class)->group(function(){
    Route::get('/reservation', 'showTables')->name('reservations.index');
    Route::post('/reservation/book', 'store')->name('reservations.store');
});

// AUTHORIZATION
Route::middleware('admin')->controller(AdminController::class)->group(function(){
    Route::get('/dashboard', 'showDashboard')->name('admin.dashboard');
    Route::get('/create', 'createItem')->name('admin.create');
    Route::post('/store', 'storeItem')->name('admin.store');
    Route::get('/edit/{id}', 'editItem')->name('admin.edit');
    Route::put('/update/{id}', 'updateItem')->name('admin.update');
    Route::delete('/delete/{id}', 'deleteItem')->name('admin.delete');

    Route::get('/bookings', 'showBookings')->name('admin.bookings');
});




