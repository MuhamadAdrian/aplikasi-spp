<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Throwable;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $userRole = auth()->user()->role;
            $currentRouteName = Route::currentRouteName();

            if (in_array($currentRouteName, $this->userAccessRole()[$userRole])) 
            {
                return $next($request);
            }
            else if ($userRole == 'petugas') {
                return Redirect::route('pembayaran');
            }
            else if ($userRole == 'siswa'){
                return Redirect::route('histori.show', ['histori_pembayaran' => auth()->user()->siswa->nisn, 'tahun' => 'semua']);
            }
            else {
                abort(403, 'Route tidak ditemukan');
            }
        }
        catch(Throwable $th){
            abort(403, 'Anda tidak memiliki izin');
        }
    }

    public function userAccessRole(){
        return [
            'admin' => [
                'dashboard',
                'laporan',
                'generate',
                'invoice',
                'register',
                'histori', //histori route
                'histori.show',
                'siswa', //siswa route
                'siswa.tambah',
                'siswa.store',
                'siswa.destroy',
                'siswa.edit',
                'siswa.update',
                'kelas', //kelas route
                'kelas.tambah',
                'kelas.store',
                'kelas.destroy',
                'kelas.edit',
                'kelas.update',
                'kelas.show',
                'spp', //spp route
                'spp.tambah',
                'spp.store',
                'spp.destroy',
                'spp.edit',
                'spp.update',
                'petugas', //petugas route
                'petugas.tambah',
                'petugas.store',
                'petugas.destroy',
                'petugas.edit',
                'petugas.update',
                'pembayaran', //pembayaran route
                'pembayaran.tambah',
                'pembayaran.store',
                'pembayaran.update',
            ],
            
            'petugas' => [
                'pembayaran', //pembayaran route
                'pembayaran.tambah',
                'pembayaran.store',
                'pembayaran.update',
                'histori', //histori route
                'histori.show',
                'invoice',
            ],

            'siswa' => [
                'histori.show'
            ]
            ];
    }
}
