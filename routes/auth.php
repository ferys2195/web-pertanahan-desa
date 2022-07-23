<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::view('/login', 'login')->name('admin.login');
Route::post('/login', LoginController::class)->name('admin.login');
Route::post('/admin/logout', LogoutController::class)->name('admin.logout');
