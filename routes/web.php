<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->group(function () {
        Route::get('/me', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile.me');
        Route::get('/edit', [\App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.edit');
        Route::post('/update', [\App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
    });

    Route::group(['middleware' => ['role:Administrator']], function () {

        // URL /auth/
        Route::prefix('auth')->group(function () {

            // URL /auth
            Route::resource('user', UserController::class);

            // URL /auth/master
            Route::prefix('master')->group(function () {
                Route::resource('barang', BarangController::class)->except(['show']);
                Route::resource('jenis-barang', JenisBarangController::class)->except(['show']);
                Route::resource('satuan-barang', SatuanBarangController::class)->except(['show']);
                Route::resource('satuan-barang', SatuanBarangController::class)->except(['show']);
                Route::resource('supplier', SupplierController::class)->except(['show']);
            });

            // URL /auth/transaksi
            Route::prefix('transaksi')->group(function () {
                Route::post('barang-masuk/addtocart', [BarangMasukController::class, 'addtocart'])->name('barang-masuk.addtocart');
                Route::delete('barang-masuk/{key}/removecartitem', [BarangMasukController::class, 'removecartitem'])->name('barang-masuk.removecartitem');
                Route::resource('barang-masuk', BarangMasukController::class);
            });
        });
    });
});
