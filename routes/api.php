<?php

use App\Http\Controllers\MaizeDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/receive-data', [MaizeDataController::class, 'receiveData']);