<?php

use App\Http\Controllers\Admin\MapsController;
use App\Http\Controllers\Admin\SuratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TanahController as AdminTanahController;

Route::view('/', 'pages.admin.dashboard');
Route::view('/verify', 'pages.admin.verify')->name('verify');
Route::view('settings', 'pages.admin.settings')->name('settings');
Route::resource('/tanah', AdminTanahController::class);
Route::get('/maps', [MapsController::class, 'index'])->name('maps');
Route::resource('/surat', SuratController::class);
Route::get('pemetaan', fn () => view('pages.admin.pemetaan'))->name('pemetaan');
