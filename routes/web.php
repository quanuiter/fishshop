<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/market', function () {
    return view('market');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/chinhsach', function () {
    return view('chinhsach');
});

Route::get('/tintuc', function () {
    return view('tintuc');
});