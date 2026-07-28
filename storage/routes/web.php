<?php

use App\Http\Controllers\Admin\BeritaCategoryController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\BeritaTagController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\BeritaPublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [App\Http\Controllers\Admin\PageController::class, 'index'])
    ->name('welcome');

// Berita Public Routes
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaPublicController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [BeritaPublicController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [BeritaPublicController::class, 'tag'])->name('tag');
    Route::get('/cari', [BeritaPublicController::class, 'search'])->name('search');
    Route::get('/{slug}', [BeritaPublicController::class, 'show'])->name('show');
    Route::post('/{id}/share', [BeritaPublicController::class, 'share'])->name('share');
});

// Messages
Route::post('/messages', [App\Http\Controllers\Admin\MessageController::class, 'store'])
    ->name('messages.store');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Messages Management
    Route::get('/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])
        ->name('messages.index');
    Route::get('/messages/{id}', [App\Http\Controllers\Admin\MessageController::class, 'show'])
        ->name('messages.show');
    Route::delete('/messages/bulk-delete', [App\Http\Controllers\Admin\MessageController::class, 'bulkDelete'])
        ->name('messages.bulkDelete');
    
    //     // Route Galeri
    //  Route::get('/galeri', [App\Http\Controllers\Admin\GaleriController::class, 'index'])->name('galeri.index');
    // Route::post('/galeri', [App\Http\Controllers\Admin\GaleriController::class, 'store'])->name('galeri.store');
    // Route::delete('/galeri/{id}', [App\Http\Controllers\Admin\GaleriController::class, 'destroy'])->name('galeri.destroy');
    // Berita Management
    Route::resource('berita', BeritaController::class)->parameters(['berita' => 'beritum']);
    Route::post('/berita/bulk-action', [BeritaController::class, 'bulkAction'])
        ->name('berita.bulk-action');
    Route::get('/berita/{beritum}/analytics', [BeritaController::class, 'analytics'])
        ->name('berita.analytics');
    Route::post('/berita/{beritum}/duplicate', [BeritaController::class, 'duplicate'])
        ->name('berita.duplicate');
    
    // Categories Management
    Route::resource('categories', BeritaCategoryController::class);
    Route::post('/categories/reorder', [BeritaCategoryController::class, 'reorder'])
        ->name('categories.reorder');
    
    // Tags Management
    Route::resource('tags', BeritaTagController::class)->except(['show']);
    Route::get('/tags/merge', [BeritaTagController::class, 'merge'])
        ->name('tags.merge');
    
    // Media Library
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MediaController::class, 'index'])
            ->name('index');
        Route::post('/upload', [App\Http\Controllers\Admin\MediaController::class, 'upload'])
            ->name('upload');
        Route::delete('/{id}', [App\Http\Controllers\Admin\MediaController::class, 'destroy'])
            ->name('destroy');
    });
    
    // Analytics Dashboard
    Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])
        ->name('analytics.index');
    Route::get('/analytics/export', [App\Http\Controllers\Admin\AnalyticsController::class, 'export'])
        ->name('analytics.export');

        // Route Pendaftaran
        Route::prefix('pendaftaran')->name('pendaftaran.')->group(function () {

        // Index — daftar semua pendaftar
        Route::get('/',             [PendaftaranController::class, 'index'])  ->name('index');

        // Store — simpan pendaftar baru (dari modal tambah)
        Route::post('/',            [PendaftaranController::class, 'store'])  ->name('store');

        // Show — halaman detail pendaftar
        Route::get('/{id}',         [PendaftaranController::class, 'show'])   ->name('show');

        // Edit — halaman form edit (dedicated page, bukan modal)
        Route::get('/{id}/edit',    [PendaftaranController::class, 'edit'])   ->name('edit');

        // Update — simpan perubahan data pendaftar
        Route::put('/{id}',         [PendaftaranController::class, 'update']) ->name('update');

        // Update Status — hanya ubah field status (dari modal status di index)
        Route::patch('/{id}/status',[PendaftaranController::class, 'updateStatus'])->name('updateStatus');

        // Destroy — hapus pendaftar
        Route::delete('/{id}',      [PendaftaranController::class, 'destroy'])->name('destroy');

    });
});

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';