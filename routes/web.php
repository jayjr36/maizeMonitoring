<?php

use App\Http\Controllers\MaizeDataController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MaizeDataController::class, 'index'])->name('maize.index');
Route::get('/fetch-latest-data', [MaizeDataController::class, 'fetchLatestData'])->name('fetch.latest.data');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
