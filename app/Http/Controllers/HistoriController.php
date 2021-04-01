<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;

use Inertia\Inertia;

class HistoriController extends Controller
{

    private $pembayaran;

    public function __construct()
    {
        $this->pembayaran = Pembayaran::with(['spp', 'petugas', 'siswa'])
        ->latest('tgl_bayar')
        ->withCasts(['tgl_bayar' => 'datetime:d M Y']);
    
    }


    public function index()
    {   
        $pembayaran = $this->pembayaran->paginate(5);
        foreach ($pembayaran->items() as $p) {
            $p->tunggakan = $p->jumlah_dibayar - $p->jumlah_masuk;
        }
        return Inertia::render('Histori/Index', [
            'histori' => $pembayaran
        ]);
    }

    public function show($nisn)
    {   
        $pembayaran = $this->pembayaran->where('nisn', $nisn)->paginate(5);
        foreach ($pembayaran->items() as $p) {
            $p->tunggakan = $p->jumlah_dibayar - $p->jumlah_masuk;
        }

        return Inertia::render('Histori/Detail', [
            'detail' => $pembayaran,
            'siswa' => Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->firstOrFail()
        ]);
    }
}

