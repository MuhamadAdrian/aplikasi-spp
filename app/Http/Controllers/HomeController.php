<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Spp;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $histori = Pembayaran::latest('tgl_bayar')->with(['siswa', 'petugas'])->limit(3)->get();
        foreach ($histori as $key) {
            $key->tgl_bayar = Carbon::parse($key->tgl_bayar)->diffForHumans();
        }
        return Inertia::render('Dashboard/Index', [
            'jumlah_siswa' => DB::table('siswa')->count(),
            'jumlah_kelas' => DB::table('kelas')->count(),
            'jumlah_spp' => DB::table('spp')->count(),
            'jumlah_petugas' => DB::table('petugas')->count(),
            'data_spp' => DB::table('spp')->orderByDesc('tahun')->limit(7)->get(),
            'kelas' => Kelas::withCount('siswa')->get(),
            'histori' => $histori
        ]);

    }
}
