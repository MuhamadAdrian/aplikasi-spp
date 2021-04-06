<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LaporanController extends Controller
{
    private $histori;
    private $total_pemasukan;
    private $total_tunggakan;

    public function index()
    {
        $tahun = DB::table('pembayaran')->select('tahun_dibayar')->distinct()->get();
        return Inertia::render('Laporan/Index', ['tahun' => $tahun]);
    }

    public function generateLaporan(Request $request)
    {
        if ($request->bulan == 'semua' && $request->tahun == 'semua') {
            $this->histori = Pembayaran::latest('tgl_bayar')->get();
            $this->total_pemasukan = Pembayaran::sum('jumlah_masuk');
            $this->total_tunggakan = Pembayaran::sum('jumlah_dibayar') - Pembayaran::sum('jumlah_masuk');
        }
        else if($request->bulan == 'semua') {
            $this->histori = Pembayaran::where('tahun_dibayar', $request->tahun)->latest('tgl_bayar')->get();
            $this->total_pemasukan =  Pembayaran::where('tahun_dibayar', $request->tahun)->sum('jumlah_masuk');
            $this->total_tunggakan =  Pembayaran::where('tahun_dibayar', $request->tahun)->sum('jumlah_dibayar') - Pembayaran::where('tahun_dibayar', $request->tahun)->sum('jumlah_masuk');
        }
        else if($request->tahun == 'semua'){
            $this->histori = Pembayaran::where('bulan_dibayar', $request->bulan)->latest('tgl_bayar')->get();
            $this->total_pemasukan =  Pembayaran::where('bulan_dibayar', $request->bulan)->sum('jumlah_masuk');
            $this->total_tunggakan =  Pembayaran::where('bulan_dibayar', $request->bulan)->sum('jumlah_dibayar') - Pembayaran::where('tahun_dibayar', $request->tahun)->sum('jumlah_masuk');
        }
        else{
            $this->histori = Pembayaran::where('tahun_dibayar', $request->tahun)
            ->where('bulan_dibayar', $request->bulan)
            ->latest('tgl_bayar')
            ->get();

            $this->total_pemasukan =  Pembayaran::where('tahun_dibayar', $request->tahun)->where('bulan_dibayar', $request->bulan)->sum('jumlah_masuk');
            $this->total_tunggakan =  Pembayaran::where('tahun_dibayar', $request->tahun)->where('bulan_dibayar', $request->bulan)->sum('jumlah_dibayar') - Pembayaran::where('tahun_dibayar', $request->tahun)->where('bulan_dibayar', $request->bulan)->sum('jumlah_masuk');
        }

        if (!$this->histori) {
            return redirect('laporan')->back()->with('toast', [
                'message' => 'Data tidak ditemukan',
                'success' => false
            ]);
        }
        /*$histori = Pembayaran::where('tahun_dibayar', $tahun)->where('bulan_dibayar', $bulan)->get();
        if (!$histori) {
            return back()->with('toast', [
                'message' => 'Data tidak ditemukan',
                'success' => false
                ]);
            }*/
            
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pdf.laporan', [
            'histori' => $this->histori,
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'total_pemasukan' => $this->total_pemasukan,
            'total_tunggakan' => $this->total_tunggakan,
        ])->setPaper('a4');
        return $pdf->stream('laporan_pembayaran_tahun_'.$request->tahun.'_bulan_'.$request->bulan.'.pdf');
    }
}
