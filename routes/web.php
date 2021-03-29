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
    
    Route::resource('data-siswa', SiswaController::class, )->names([
        'index' => 'siswa',
        'create' => 'siswa.tambah',
        'store' => 'siswa.store'
    ]);

    Route::resource('data-kelas', KelasController::class)->names([
        'index' => 'kelas',
        'create' => 'kelas.tambah'
    ]);
    
    Route::resource('data-spp', SppController::class)->names([
        'index' => 'spp',
        'create' => 'spp.tambah'
    ]);

    Route::resource('data-petugas', PetugasController::class)->names([
        'index' => 'petugas',
        'create' => 'petugas.tambah'
    ]);

    Route::resource('entri-transaksi-pembayaran', PembayaranController::class)->names([
        'index' => 'pembayaran',
        'create' => 'pembayaran.tambah',
        'store' => 'pembayaran.store',
        'destroy' => 'pembayaran.destroy'
    ]);

    Route::resource('histori-pembayaran', HistoriController::class)->names([
        'index' => 'histori',
        'show' => 'histori.show',
        'destroy' => 'histori.destroy'
    ]);

    Route::get('/generate-laporan', [LaporanController::class, 'index'])->name('laporan');
});


require __DIR__.'/auth.php';
