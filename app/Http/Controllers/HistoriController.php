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
        return Inertia::render('Histori/Index', [
            'histori' => $this->pembayaran->paginate(5)
        ]);
    }

    public function show($nisn)
    {   
        return Inertia::render('Histori/Detail', [
            'detail' => $this->pembayaran->where('nisn', $nisn)->paginate(5),
            'siswa' => Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->firstOrFail()
        ]);
    }
}

