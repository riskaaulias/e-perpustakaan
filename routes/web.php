<?php

use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    if (auth()->check()) {
        return auth()->user()->role == 'admin' 
            ? redirect()->route('admin.home') 
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->middleware('auth')->name('home');

    Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    Route::post('/peminjaman/{id}/setujui', [PeminjamanController::class, 'setujui'])->name('peminjaman.setujui');
    Route::post('/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('peminjaman.tolak');

    Route::get('/buku/{buku}/image', [BukuController::class, 'image'])->name('buku.image');
    Route::resource('buku', BukuController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('anggota', AnggotaController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('pengembalian', PengembalianController::class);

    Route::get('/katalog', [UserController::class, 'katalog'])->name('user.katalog');
    Route::post('/pinjam-buku', [UserController::class, 'pinjamStore'])->name('user.pinjam.store');
    Route::get('/riwayat', [UserController::class, 'riwayat'])->name('user.riwayat');
});