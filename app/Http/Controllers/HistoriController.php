<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'histori' => $pembayaran,
            'tahun' => DB::table('pembayaran')->select('tahun_dibayar')->distinct()->get(),
        ]);
    }

    public function show(Request $request, $nisn)
    {   
        $pembayaran = null;
        if ($request->tahun=="semua") {
           $pembayaran = $this->pembayaran->where('nisn', $nisn)->paginate(10);
        }
        else{
            $pembayaran = $this->pembayaran->where('nisn', $nisn)->where('tahun_dibayar', $request->tahun)->paginate(10);
        }
        
        if ($pembayaran->isEmpty()) {
            return back()->with('toast', [
                'message' => 'Data tidak ditemukan',
                'success' => false
            ]);
        }
            
        foreach ($pembayaran->items() as $p) {
            $p->tunggakan = $p->jumlah_dibayar - $p->jumlah_masuk;
        }

        return Inertia::render('Histori/Detail', [
            'detail' => $pembayaran,
            'siswa' => Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->firstOrFail()
        ]);

    }
}

