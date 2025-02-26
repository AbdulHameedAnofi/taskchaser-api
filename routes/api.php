<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('signin', [LoginController::class, 'signin'])->name('signin');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('products', [ProductController::class, 'getProducts'])->name('products');

    Route::post('cart', [CartController::class, 'addToCart'])->name('cart');
    Route::delete('cart/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    Route::post('checkout', [CartController::class, 'checkoutCart'])->name('checkout');

    Route::post('add-product', [ProductController::class, 'addProduct']);
    Route::get('get-cart', [CartController::class, 'getCart']);
});

