<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/market', [ProductController::class, 'index'])->name('market.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/chinhsach', function () {
    return view('chinhsach');
});

Route::get('/tintuc', function () {
    return view('tintuc');
});
Route::get('/khuyenmai', function () {
    return view('khuyenmai');
});

Route::get('/market/filter', [ProductController::class, 'filter'])->name('market.filter');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{variantId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
