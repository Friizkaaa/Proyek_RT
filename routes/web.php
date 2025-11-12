<?php

use Illuminate\Support\Facades\Route;

// Route homepage
Route::get('/', function () {
    return view('page.homepage'); // path view tanpa .blade.php
})->name('page');