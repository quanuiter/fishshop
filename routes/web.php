<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

