<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\KantorCabangController;
use App\Http\Controllers\LaporanBarangKeluarController;
use App\Http\Controllers\LaporanBarangMasukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanStokBarangController;
use App\Http\Controllers\SatuanBarangController;
use App\Http\Controllers\StokBarangAwalController;
use App\Http\Controllers\StokOpnameBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

// API get data barang 
Route::get('/api/barang/{kode_barang}', function(Request $request, $kode_barang){
    $request->merge(['kode_barang' => $kode_barang]);

    $validated = $request->validate([
        'kode_barang' => 'required|string|max:255',
    ]);

    $barang = \App\Models\Barang::where('kode', $validated['kode_barang'])->first();

    if ($barang) {
        return response()->json([
            'success' => true,
            'nama_barang' => $barang->nama,
            'satuan' => $barang->satuan->nama,
            'kode' => $barang->kode,
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Barang tidak ditemukan',
    ]);
})->name('api.get-barang');

Route::get('/api/barang-list', function () {
    $barang = \App\Models\Barang::with(['satuan'])->get(); // Ambil semua barang dari database
    return datatables()->of($barang)->make(true); // Menggunakan datatables untuk response JSON
})->name('api.get-barang-list');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->group(function () {
        Route::get('/me', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile.me');
        Route::get('/edit', [\App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.edit');
        Route::post('/update', [\App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update');
    });

    Route::group(['middleware' => ['role:Admin']], function () {

        // URL /auth/
        Route::prefix('auth')->group(function () {

            // URL /auth
            Route::resource('user', UserController::class);

            // settings/general-settings
            Route::get('settings/general-settings', [GeneralSettingController::class, 'index'])->name('settings.general-settings');
            Route::post('settings/general-settings', [GeneralSettingController::class, 'store'])->name('settings.general-settings.store');
            
            // settings/backup
            Route::get('settings/backup', [BackupController::class, 'index'])->name('settings.backup');
            Route::get('settings/backup/status', [BackupController::class, 'backupStatuses'])->name('settings.backup-status');
            Route::get('settings/backup/files', [BackupController::class, 'getFiles'])->name('settings.backup-files');
            Route::post('settings/backup', [BackupController::class, 'createBackup'])->name('settings.backup-create');
            Route::post('settings/backup/download', [BackupController::class, 'downloadBackup'])->name('settings.backup-download');
            Route::delete('settings/backup/delete', [BackupController::class, 'deleteFile'])->name('settings.backup-delete');
        });
    });

    Route::group(['middleware' => ['role:Admin|Admin ATK']], function () {
        Route::prefix('auth')->group(function () {

            // URL /auth/master
            Route::prefix('master')->group(function () {
                Route::get('barang/{barang}/penyesuaian-stok', [BarangController::class, 'adjustmentStok'])->name('barang.adjust-stok');
                Route::post('barang/{barang}/penyesuaian-stok', [BarangController::class, 'adjustmentStokStore'])->name('barang.adjust-stok-store');
                Route::resource('barang', BarangController::class);
                Route::resource('jenis-barang', JenisBarangController::class)->except(['show']);
                Route::resource('satuan-barang', SatuanBarangController::class)->except(['show']);
                Route::resource('satuan-barang', SatuanBarangController::class)->except(['show']);
                Route::resource('supplier', SupplierController::class)->except(['show']);
                Route::post('kantor-cabang/{kantor_cabang}/user', [KantorCabangController::class, 'addUser'])->name('kantor-cabang.addUser');
                Route::delete('kantor-cabang/{kantor_cabang}/user', [KantorCabangController::class, 'deleteUser'])->name('kantor-cabang.deleteUser');
                Route::resource('kantor-cabang', KantorCabangController::class);
                
                // Stok Opname Barang
                Route::post('stok-opname-barang/{stokOpnameBarang}/download', [StokOpnameBarangController::class, 'downloadBarangStokOpname'])->name('stok-opname-barang.download');
                
                Route::post('stok-opname-barang/{stokOpnameBarang}/upload', [StokOpnameBarangController::class, 'uploadBarangStokOpname'])->name('stok-opname-barang.upload');

                Route::get('stok-opname-barang/{stokOpnameBarang}/cetak-kartu', [StokOpnameBarangController::class, 'printKartuStokOpname'])->name('stok-opname-barang.cetakStok');
                Route::patch('stok-opname-barang/{detailStokOpnameBarang}/update-stok-fisik', [StokOpnameBarangController::class, 'updateStokFisik'])->name('stok-opname-barang.updateStokFisik');
                Route::patch('stok-opname-barang/{stokOpnameBarang}/cancel-stok-opname', [StokOpnameBarangController::class, 'batalSOBarang'])->name('stok-opname-barang.cancelStokOpname');
                Route::resource('stok-opname-barang', StokOpnameBarangController::class);

                // Stok Awal
                Route::post('stok-awal/addtocart', [StokBarangAwalController::class, 'addtocart'])->name('stok-awal.addtocart');
                Route::delete('stok-awal/{key}/removecartitem', [StokBarangAwalController::class, 'removecartitem'])->name('stok-awal.removecartitem');
                Route::post('stok-awal', [StokBarangAwalController::class, 'store'])->name('stok-awal.store');
                Route::get('stok-awal', [StokBarangAwalController::class, 'create'])->name('stok-awal.add');


            });

            // URL /auth/transaksi
            Route::prefix('transaksi')->group(function () {

                // URL /auth/transaksi/barang-masuk
                Route::get('barang-masuk/checkout', [BarangMasukController::class, 'checkout'])->name('barang-masuk.checkout');
                Route::post('barang-masuk/emptyCart', [BarangMasukController::class, 'emptyCart'])->name('barang-masuk.emptyCart');
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

    Route::group(['middleware' => ['role:Admin|Admin ATK|Manager|Kontrol Internal']], function () {
        Route::prefix('auth')->group(function () {

            //URL 
            Route::prefix('laporan')->group(function () {
                Route::get('stok-barang', [LaporanStokBarangController::class, 'index'])->name('laporan.stok-barang.index');
                Route::post('stok-barang', [LaporanStokBarangController::class, 'printPDF'])->name('laporan.stok-barang.print');
                
                Route::get('barang-masuk', [LaporanBarangMasukController::class, 'index'])->name('laporan.barang-masuk.index');
                Route::post('barang-masuk', [LaporanBarangMasukController::class, 'printPDF'])->name('laporan.barang-masuk.print');
                                
                Route::get('barang-keluar', [LaporanBarangKeluarController::class, 'index'])->name('laporan.barang-keluar.index');
                Route::post('barang-keluar', [LaporanBarangKeluarController::class, 'printPDF'])->name('laporan.barang-keluar.print');
            });

        });
    });

    
});
