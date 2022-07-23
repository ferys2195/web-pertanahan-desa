<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home');
require __DIR__ . '/auth.php';
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {
        require __DIR__ . '/administrator.php';
    });
