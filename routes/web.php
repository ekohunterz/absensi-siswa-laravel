<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('data_siswa', DataSiswaController::class)->middleware('auth');
Route::resource('/admin/kelas', KelasController::class)->middleware('admin');
Route::resource('/admin/jurusan', JurusanController::class)->middleware('admin');
Route::resource('/admin/data_guru', UserController::class)->middleware('admin');
Route::resource('/admin/mapel', MapelController::class)->middleware('admin');
Route::resource('/admin/tahun_ajaran', TahunAjaranController::class)->middleware('admin');
Route::resource('/jadwal', JadwalController::class)->middleware('auth');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/guru/absen', [AbsenController::class, 'index'])->middleware('auth');
Route::get('/data_absen', [AbsenController::class, 'data_absen'])->middleware('auth');
Route::post('/data_absen/update', [AbsenController::class, 'update'])->middleware('auth');
Route::get('/data_rekap', [AbsenController::class, 'data_rekap'])->middleware('auth');
Route::post('/absen', [AbsenController::class, 'store'])->middleware('auth');
Route::get('/guru/data_rekap/export', [AbsenController::class, 'export'])->middleware('auth');
Route::get('/guru/data_absen/export', [AbsenController::class, 'export_hadir'])->middleware('auth');


