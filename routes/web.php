<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\DeleteController;


//Tampilkan Halaman Login
Route::get('/', [PagesController::class, 'login'])->name('login');
//Fungsi Untuk Login
Route::post('/login/send', [AuthController::class, 'login'])->name('login.dashboard');

//Middleware Login
Route::middleware(['auth'])->group(function () {
//Halaman Dashboard
Route::get('/dashboard', [PagesController::class, 'index'])->name('dashboard');

//Halaman Data Pasien
Route::get('/dashboard/data/pasien', [PagesController::class, 'pasien'])->name('data.pasien');
//Fungsi Tambah Data Pasien
Route::post('/dashboard/data/pasien/add', [AddController::class, 'pasien'])->name('pasien.add');
// Route untuk proses hapus pasien via method DELETE
Route::delete('/dashboard/data/pasien/delete', [DeleteController::class, 'pasien'])->name('pasien.delete');
//Route untuk proses update pasien via method PUT
Route::put('/dashboard/data/pasien/update', [UpdateController::class, 'pasien'])->name('pasien.update');


//Halaman Daftar Kunjungan & Filter
Route::match(['get', 'post'], '/dashboard/data/kunjungan', [PagesController::class, 'kunjungan'])->name('data.kunjungan');
//Route Fungsi Tambah Data Daftar Kunjungan
Route::post('/dashboard/data/kunjungan/add', [AddController::class, 'kunjungan'])->name('kunjungan.add');
// Hapus kunjungan
Route::delete('/dashboard/data/kunjungan/delete', [DeleteController::class, 'kunjungan'])->name('kunjungan.delete');
// Update kunjungan
Route::put('/dashboard/data/kunjungan/update', [UpdateController::class, 'kunjungan'])->name('kunjungan.update');
// POST detail untuk Halaman Detail Kunjungan — diproses di controller
Route::post('/dashboard/data/kunjungan/detail', [PagesController::class, 'kunjunganDetail'])->name('kunjungan.detail');
// GET detail untuk Halaman Detail Kunjungan — redirect supaya tidak error
Route::get('/dashboard/data/kunjungan/detail', function () {
    return redirect()->route('data.kunjungan')->with('error', 'Akses langsung tidak diperbolehkan.');
});


//Halaman Riwayat Kunjungan & Search
Route::match(['get', 'post'], '/dashboard/data/riwayat', [PagesController::class, 'riwayat'])->name('data.riwayat');
// POST detail untuk Halaman Detail Riwayat — diproses di controller
Route::post('/dashboard/data/riwayat/detail', [PagesController::class, 'riwayatDetail'])->name('riwayat.detail');
// GET detail untuk Halaman Detail Riwayat — redirect supaya tidak error
Route::get('/dashboard/data/riwayat/detail', function () {
    return redirect()->route('data.riwayat')->with('error', 'Akses langsung tidak diperbolehkan.');
});


//Halaman Profile
Route::get('/dashboard/profile', [PagesController::class, 'profile'])->name('profile');
//Update Profile
Route::post('/dashboard/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

//Fungsi Untuk Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
