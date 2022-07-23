<?php

use App\Http\Controllers\Admin\MapsController;
use App\Http\Controllers\Admin\SuratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TanahController as AdminTanahController;

Route::view('/', 'dashboard');
Route::view('/verify', 'verify');
Route::resource('/tanah', AdminTanahController::class);
Route::get('/maps', [MapsController::class, 'index'])->name('maps');
Route::resource('/surat', SuratController::class);
