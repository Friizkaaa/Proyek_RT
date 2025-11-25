<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage (terbuka untuk semua)
Route::get('/', function () {
    return view('page.homepage');
})->name('homepage');

// Halaman Login
Route::get('/page/masukpage', [AuthController::class, 'showLoginForm'])->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login']);

// Halaman Daftar
Route::get('/page/daftarpage', function () {
    return view('page.daftarpage');
})->name('daftar');

// Form Galeri
Route::get('/page/formgaleri', function () {
    return view('page.formgaleri');
})->name('formgaleri');

// Form Tambah Kegiatan
Route::get('/page/formact', function () {
    return view('page.formact');
})->name('formact');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');