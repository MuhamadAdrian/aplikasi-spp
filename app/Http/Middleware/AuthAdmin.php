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
                return Redirect::route('histori');
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
                'siswa',
                'petugas',
                'kelas',
                'spp',
                'pembayaran',
                'histori',
                'laporan',
                'register',
                'siswa.tambah',
                'siswa.store',
                'data-siswa.destroy',
                'data-siswa.edit',
                'data-siswa.update',
                'kelas.tambah',
                'data-kelas.store',
                'data-kelas.destroy',
                'data-kelas.edit',
                'data-kelas.update',
                'data-kelas.show',
                'spp.tambah',
                'data-spp.store',
                'data-spp.destroy',
                'data-spp.edit',
                'data-spp.update',
                'data-spp.show',
            ],

            'petugas' => [
                'pembayaran',
                'histori'
            ],

            'siswa' => [
                'histori'
            ]
            ];
    }
}
