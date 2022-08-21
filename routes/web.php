<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/', [HomeController::class, 'store'])->middleware('auth')->name('home.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');

Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cart', [ShoppingCartController::class, 'index'])->middleware('auth')->name('cart.index');


