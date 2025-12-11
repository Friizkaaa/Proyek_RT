<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GaleriController;
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

// Halaman Register
Route::get('/page/daftarpage', [AuthController::class, 'showRegisterForm'])->name('register');

// Proses Register
Route::post('/register', [AuthController::class, 'register'])->name('post-register');

// Proses Upload Foto Galeri
Route::post('/page/formgaler', [GaleriController::class, 'postFormGaleri'])->name('post-galeri');

// Form Galeri
Route::get('/page/formgaleri', [GaleriController::class, 'getFormGaleri'])->name('get-galeri');

// Form Tambah Kegiatan
Route::get('/page/formact', [PageController::class, 'getTambahKegiatan'])->name('formact');

// Proses Tambah Kegiatan
Route::post('/page/formact', [PageController::class, 'postTambahKegiatan'])->name('post-formact');

// Proses Hapus Galeri
Route::delete('/galeri/{id}', [GaleriController::class, 'postDeletefoto'])->name('delete-galeri');

Route::delete('/kegiatan/{id}', [GaleriController::class, 'deleteKegiatan'])->name('delete-kegiatan');

// Json Kegiatan
Route::get('/api/kegiatan', [PageController::class, 'getKegiatan'])->name('aktivitas');


// Form Tambah Kegiatan
// Route::get('/page/formact', function () {
//     return view('page.formact');
// })->name('formact');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');