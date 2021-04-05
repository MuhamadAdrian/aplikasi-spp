<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Inertia\Inertia;

class HistoriController extends Controller
{

    private $pembayaran;
    private $daftar_tahun;

    public function __construct()
    {
        $this->pembayaran = Pembayaran::with(['spp', 'petugas', 'siswa'])
        ->latest('tgl_bayar')
        ->withCasts(['tgl_bayar' => 'datetime:d M Y']);

        $this->daftar_tahun = DB::table('pembayaran')->select('tahun_dibayar')->distinct()->get();
    
    }


    public function index()
    {   
        
        $this->pembayaran = $this->pembayaran->paginate(5);
        foreach ($this->pembayaran->items() as $p) {
            $p->tunggakan = $p->jumlah_dibayar - $p->jumlah_masuk;
        }

        return Inertia::render('Histori/Index', [
            'histori' =>$this->pembayaran,
            'tahun' => $this->daftar_tahun,
        ]);
        //$pembayaran = $this->pembayaran->paginate(5);
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
        
        if (!$pembayaran->isEmpty()) {
            foreach ($pembayaran->items() as $p) {
                $p->tunggakan = $p->jumlah_dibayar - $p->jumlah_masuk;
                $p->waktu = Carbon::parse($p->tgl_bayar)->diffForHumans();
            }
            return Inertia::render('Histori/Detail', [
                'detail' => $pembayaran,
                'siswa' => Siswa::with(['kelas', 'spp'])->where('nisn', $nisn)->firstOrFail(),
                'daftar_tahun' => $this->daftar_tahun
            ]);
        }
        
        return back()->with('toast', [
            'message' => 'Data tidak ditemukan',
            'success' => false
        ]);
    }

    public function cetakInvoice($id)
    {
        $histori = Pembayaran::where('id', $id)->first();

        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        
        $pdf = PDF::loadView('pdf.bukti-pembayaran', [
            'histori' => $histori
        ])->setPaper('a4');

        return $pdf->stream('butki_pembayaran_'.$histori->tgl_bayar.'.pdf');
    }
}

