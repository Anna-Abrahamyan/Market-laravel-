<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'show'])->name('home');

Route::post('/', [HomeController::class, 'addProductToCart'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'show']);

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/register', [RegisterController::class, 'register'])->name('register-form');

Route::post('/login', [LoginController::class, 'login'])->name('login-form');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout-form');

Route::get('/cart', [ShoppingCartController::class, 'getUserProducts'])->middleware('auth')->name('shopping-cart');


