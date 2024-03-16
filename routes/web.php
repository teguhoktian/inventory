<?php

use App\Http\Controllers\KunjunganPasienController;
use App\Http\Controllers\MasterDusunController;
use App\Http\Controllers\PasienController;
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

            // URL /auth/master/
            Route::prefix('master')->group(function () {
                Route::resource('user', UserController::class);
            });
        });
    });
});
