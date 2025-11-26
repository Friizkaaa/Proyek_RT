<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage (terbuka untuk semua)
Route::get('/', [PageController::class, 'getHomePage'])->name('homepage');

// Halaman Login
Route::get('/page/masukpage', [AuthController::class, 'showLoginForm'])->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login'])->name('post-login');

//Halaman Register
Route::get('/page/daftarpage', [AuthController::class, 'showRegisterForm'])->name('register');

//Proses Register
Route::post('/register', [AuthController::class, 'register'])->name('post-register');

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