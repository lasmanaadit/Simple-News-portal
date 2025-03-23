<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
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

Route::get('/', [MainController::class, 'index']);
Route::prefix('/admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Rute kategori berita
    Route::resource('/kategori', CategoryController::class);
    Route::controller(NewsController::class)->prefix('news')->group(function () {
        Route::get('/', 'index')->name('news.index'); // Tampilkan daftar berita
        Route::get('/create', 'create')->name('news.create'); // Form tambah berita
        Route::post('/store', 'store')->name('news.store'); // Simpan berita baru
        Route::post('/upload-image', 'uploadImage')->name('news.uploadImage'); // Upload gambar berita
        
        // 🔥 Tambahin rute edit, update, dan delete berita
        Route::get('/{news}/edit', 'edit')->name('news.edit'); // Form edit berita
        Route::put('/{news}', 'update')->name('news.update'); // Simpan perubahan berita
        Route::delete('/{id}', 'destroy')->name('news.destroy'); // Hapus berita
    });
});
