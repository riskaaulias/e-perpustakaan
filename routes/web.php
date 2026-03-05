<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AnggotaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('buku', BukuController::class);

Route::resource('petugas', PetugasController::class);

Route::resource('anggota', AnggotaController::class);

Route::resource('peminjaman', PeminjamanController::class);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin/dashboard');

