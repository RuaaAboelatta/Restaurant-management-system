<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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
Route::get('/cart', function () {
    return view('layout.cart');
});
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


// AUTHORIZATION
Route::middleware('admin')->controller(AdminController::class)->group(function(){
    Route::get('/dashboard', 'showDashboard')->name('admin.dashboard');
    Route::get('/create', 'createItem')->name('admin.create');
    Route::post('/store', 'storeItem')->name('admin.store');
    Route::get('/edit/{id}', 'editItem')->name('admin.edit');
    Route::put('/update/{id}', 'updateItem')->name('admin.update');
    Route::delete('/delete/{id}', 'deleteItem')->name('admin.delete');

});
