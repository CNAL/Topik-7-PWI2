<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda');
});

Route::get('/about', function () {
    return view('pages.about', [
        'nama'  => 'Chrysels Nicha Aime Laoh',
        'kelas' => 'D4SM-48-01',
        'nim'   => '707082400010',
    ]);
});

Route::view('/contact', 'pages.contact');

// Satu controller dapat memiliki beberapa method
Route::get('/product', [ProductController::class, 'getProduct']);
Route::get('/product/addProduct', [ProductController::class, 'addProduct']);

use App\Http\Controllers\SapaController;

Route::get('/sapa', [SapaController::class, 'index']);

use App\Http\Controllers\MahasiswaController;

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
