<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\KantorCabangController;
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
        });
    });

    Route::group(['middleware' => ['role:Administrator|Admin ATK']], function () {
        Route::prefix('auth')->group(function () {

            // URL /auth/master
            Route::prefix('master')->group(function () {
                Route::resource('barang', BarangController::class);
                Route::resource('jenis-barang', JenisBarangController::class)->except(['show']);
                Route::resource('satuan-barang', SatuanBarangController::class)->except(['show']);
                Route::resource('satuan-barang', SatuanBarangController::class)->except(['show']);
                Route::resource('supplier', SupplierController::class)->except(['show']);
                Route::resource('kantor-cabang', KantorCabangController::class)->except(['show']);
            });

            // URL /auth/transaksi
            Route::prefix('transaksi')->group(function () {

                // URL /auth/transaksi/barang-masuk
                Route::post('barang-masuk/addtocart', [BarangMasukController::class, 'addtocart'])->name('barang-masuk.addtocart');
                Route::post('barang-masuk/{barang_masuk}/print', [BarangMasukController::class, 'print'])->name('barang-masuk.print');
                Route::delete('barang-masuk/{key}/removecartitem', [BarangMasukController::class, 'removecartitem'])->name('barang-masuk.removecartitem');
                Route::resource('barang-masuk', BarangMasukController::class)->except(['update', 'edit']);;

                // URL /auth/transaksi/barang-masuk
                Route::post('barang-keluar/{barang_keluar}/print', [BarangKeluarController::class, 'print'])->name('barang-keluar.print');
                Route::post('barang-keluar/addtocart', [BarangKeluarController::class, 'addtocart'])->name('barang-keluar.addtocart');
                Route::delete('barang-keluar/{key}/removecartitem', [BarangKeluarController::class, 'removecartitem'])->name('barang-keluar.removecartitem');
                Route::get('barang-keluar/{id}/getLastPrice', [BarangKeluarController::class, 'getLastPrice'])->name('barang-keluar.getLastPrice');
                Route::resource('barang-keluar', BarangKeluarController::class)->except(['update', 'edit']);
            });
        });
    });
});
