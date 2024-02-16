<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfilController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login1', [AuthController::class, 'login'])->name('post-login');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::resource('/produk', ProdukController::class)->middleware('ckLogin');
Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');
Route::get('/exportexcel', [ProdukController::class,'exportExcel'])->name('exportexcel');
Route::get('/exportexcel/{id}', [ProdukController::class,'exportExcelfilter'])->name('exportexcelfilter');
Route::get('/profil', [ProfilController::class,'index'])->name('profil');
