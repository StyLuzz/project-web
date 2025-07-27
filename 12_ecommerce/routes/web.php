<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProductController;

Route::get('/', HomeController::class . '@index')->name('home');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

Route::get('/product', function () {
    return 'Ini adalah route untuk produk';
});

Route::get('/checkout', function () {
    return 'Ini adalah route untuk checkout';
});

Route::get('/coba', [ContohController::class, 'coba'])->name('coba');

Route::get('/contoh', [App\Http\Controllers\ContohController::class, 'index']);
Route::resource('products-resource', App\Http\Controllers\ProductController::class);