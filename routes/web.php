<?php

use App\Http\Controllers\HistoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\LaporanController;
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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/



/*Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware(['auth', 'verified', 'authadmin'])->group(function () {

    
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    
    Route::resource('data-siswa', SiswaController::class, )
    ->except(['show'])
    ->names([
        'index' => 'siswa',
        'create' => 'siswa.tambah',
        'store' => 'siswa.store',
        'destroy' => 'siswa.destroy',
        'edit' => 'siswa.edit',
        'update' => 'siswa.update'
    ]);

    Route::resource('data-kelas', KelasController::class)->names([
        'index' => 'kelas',
        'create' => 'kelas.tambah',
        'store' => 'kelas.store',
        'destroy' => 'kelas.destroy',
        'edit' => 'kelas.edit',
        'update' => 'kelas.update',
        'show' => 'kelas.show'
    ]);
    
    Route::resource('data-spp', SppController::class)
    ->except(['show'])
    ->names([
        'index' => 'spp',
        'create' => 'spp.tambah',
        'store' => 'spp.store',
        'destroy' => 'spp.destroy',
        'edit' => 'spp.edit',
        'update' => 'spp.update'
    ]);

    Route::resource('data-petugas', PetugasController::class)
    ->except(['show'])
    ->names([
        'index' => 'petugas',
        'create' => 'petugas.tambah',
        'store' => 'petugas.store',
        'destroy' => 'petugas.destroy',
        'edit' => 'petugas.edit',
        'update' => 'petugas.update'
    ]);

    Route::resource('entri-transaksi-pembayaran', PembayaranController::class)
    ->except(['show', 'edit'])
    ->names([
        'index' => 'pembayaran',
        'create' => 'pembayaran.tambah',
        'store' => 'pembayaran.store',
        'destroy' => 'pembayaran.destroy',
        'update' => 'pembayaran.update'
    ]);

    Route::resource('histori-pembayaran', HistoriController::class)
    ->except(['create', 'update', 'edit', 'store'])
    ->names([
        'index' => 'histori',
        'show' => 'histori.show',
        'destroy' => 'histori.destroy'
    ]);

    Route::get('/generate-laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/generate-laporan/generate', [LaporanController::class, 'generateLaporan'])->name('generate');

    Route::get('/histori/{id}/cetak', [HistoriController::class, 'cetakInvoice'])->name('invoice');
});


require __DIR__.'/auth.php';
