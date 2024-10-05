<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\TambahDataController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , [LoginController::class, 'index'])->name('login'); 
Route::post('/login-proses' , [LoginController::class, 'login_proses'])->name('login-proses'); 
Route::get('/tambah-mahasiswa' , [LoginController::class, 'register'])->name('register');
Route::post('/register-proses' , [LoginController::class, 'register_proses'])->name('register-proses');
Route::get('/dashboard' , [LoginController::class, 'dashboard'])->name('dashboard'); 
Route::get('/navbar', [NavbarController::class, 'navbar'])->name('navbar');
// Route::get('/users', [LoginController::class, 'view'])->name('users.view');
Route::get('/tampilan_kaprodi', [LoginController::class, 'tampilan_kaprodi']);
Route::get('/kaprodi', [LoginController::class, 'kaprodi'])->name('kaprodi');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/mahasiswa', [LoginController::class, 'mahasiswa'])->name('mahasiswa');
Route::get('/tampilan_mahasiswa', [LoginController::class, 'tampilan_mahasiswa'])->name('tampilan_mahasiswa');
Route::get('/tambah_kaprodi', [TambahDataController::class, 'tambah_kaprodi'])->middleware('auth')->name('tambah_kaprodi');
Route::post('/proses_tambah', [TambahDataController::class, 'proses_tambah'])->name('proses_tambah');
Route::post('/tambah', [TambahDataController::class, 'tambah_kelas'])->name('tambah');
Route::delete('/hapus_kelas/{id}', [TambahDataController::class, 'hapus_kelas'])->name('hapus_kelas');
Route::get('/tambah_mahasiswa', [TambahDataController::class, 'tambah_mahasiswa'])->middleware('auth')->name('tambah_mahasiswa');
Route::get('/view_mahasiswa', [TambahDataController::class, 'view_kelas'])->middleware('auth')->name('view_kelas');
Route::get('/profile', [LoginController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/profile_view', [LoginController::class, 'profile_view'])->middleware('auth')->name('profile_view');
Route::post('/proses', [TambahDataController::class, 'proses'])->name('proses');
Route::get('/dosen', [LoginController::class, 'dosen'])->name('dosen');
Route::post('/proses_dosen', [TambahDataController::class, 'proses_dosen'])->name('proses_dosen');
Route::get('/tambah_dosen', [TambahDataController::class, 'tambah_dosen'])->middleware('auth')->name('tambah_dosen');
Route::get('/tampilan_dosen', [TambahDataController::class, 'tampilan_dosen'])->name('tampilan_dosen');
Route::get('/dosen_tampilan', [TambahDataController::class, 'dosen_tampilan'])->name('dosen_tampilan');
Route::delete('/hapus_mahasiswa/{id}', [TambahDataController::class, 'hapus_mahasiswa'])->name('hapus_mahasiswa');
Route::get('/edit/{id}/edit', [TambahDataController::class, 'edit'])->name('edit');
Route::put('/edit_mahasiswa/{id}', [TambahDataController::class, 'edit_mahasiswa'])->name('edit_mahasiswa');
Route::get('/request' , [LoginController::class, 'request'])->name('request'); 
Route::get('/data_request' , [LoginController::class, 'data_request'])->name('data_request'); 
Route::post('/tambah_permintaan', [TambahDataController::class, 'tambah_permintaan'])->name('tambah_permintaan');
// Route untuk menyetujui permintaan
Route::post('/setuju/{id}', [TambahDataController::class, 'setuju'])->name('setuju');
Route::post('/tolak/{id}', [TambahDataController::class, 'tolak'])->name('tolak');
Route::delete('/hapus_dosen/{id}', [TambahDataController::class, 'hapus_dosen'])->name('hapus_dosen');
Route::get('/data_kelas' , [LoginController::class, 'data_kelas'])->name('data_kelas'); 
Route::get('/tambah_kls' , [LoginController::class, 'tambah_kls'])->name('tambah_kls');
Route::get('/edit_kelas/{id}', [TambahDataController::class, 'edit_kelas'])->name('edit_kelas');
Route::put('/update_kelas/{id}', [TambahDataController::class, 'update_kelas'])->name('update_kelas');
Route::delete('/hapus_kaprodi/{id}', [TambahDataController::class, 'hapus_kaprodi'])->name('hapus_kaprodi');
Route::get('/edit_kaprodi/{id}', [TambahDataController::class, 'edit_kaprodi'])->name('edit_kaprodi');
Route::put('/update_kaprodi/{id}', [TambahDataController::class, 'update_kaprodi'])->name('update_kaprodi');




//menampilkan data mahasiswa perkelas
Route::get('/tampilan_mhs', [LoginController::class, 'tampilan_mhs'])->name('tampilan_mhs');
// Route::get('/tampilan_kls', [LoginController::class, 'tampilan_kls'])->name('tampilan_kls');
// web.php
Route::post('/mahasiswa/{id}/keluar', [LoginController::class, 'keluarKelas'])->name('keluarKelas');


//nampilin kaprodi
Route::get('/view_kaprodi' , [LoginController::class, 'view_kaprodi'])->name('view_kaprodi');
Route::post('/kaprodi_proses' , [LoginController::class, 'kaprodi_proses'])->name('kaprodi_proses');

Route::post('/ubah-kelas/{mahasiswa}', [LoginController::class, 'ubahKelas'])->name('ubahKelas');







// Route::post('/tambah', [TambahDataController::class, 'tambah']);

