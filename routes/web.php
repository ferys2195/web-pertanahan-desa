<?php

use Illuminate\Support\Facades\Route;
use PhpOffice\PhpWord\TemplateProcessor;

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
Route::get('test', function () {
    $template = new TemplateProcessor('assets/documents/spt.docx');
    $template->setImageValue('sket', ['path' => 'assets/images/sket.jpg', 'width' => 378, 'height' => 378, 'ratio' => false]);
    $pathToSave = 'assets/documents/' . "holla"  . '-' . date('d-m-Y') . '.docx';
    $template->saveAs($pathToSave);
    return response()->download(public_path($pathToSave))->deleteFileAfterSend(true);
});
