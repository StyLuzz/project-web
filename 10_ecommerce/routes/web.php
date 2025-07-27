<?php

use Illuminate\Support\Facades\Route;

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