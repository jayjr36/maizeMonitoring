<?php

use App\Http\Controllers\MaizeDataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [MaizeDataController::class, 'index'])->name('maize.index');
Route::get('/fetch-latest-data', [MaizeDataController::class, 'fetchLatestData'])->name('fetch.latest.data');
Auth::routes();

Route::get('/ho', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
