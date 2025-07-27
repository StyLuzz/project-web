<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return 'Ini route utama';
});

Route::get('/product', function () {
    return 'Ini adalah route untuk produk';
});

Route::get('/cart', function () {
    return 'Ini adalah route untuk keranjang belanja';
});

Route::get('/checkout', function () {
    return 'Ini adalah route untuk checkout';
});

Route::get('/contoh', [App\Http\Controllers\ContohController::class, 'index']);
Route::resource('products-resource', App\Http\Controllers\ProductController::class);