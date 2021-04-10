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
        return Inertia::render('Dashboard/Index', [
            'jumlah_siswa' => DB::table('siswa')->groupBy()->count(),
            'jumlah_kelas' => DB::table('kelas')->count(),
            'jumlah_spp' => DB::table('spp')->count(),
            'jumlah_petugas' => DB::table('petugas')->count(),
            'data_spp' => DB::table('spp')->orderByDesc('tahun')->limit(7)->get(),
            'kelas' => Kelas::withCount('siswa')->get(),
            'histori' => $this->getPembayaranTerakhir(),
            'pemasukan' => [
                'bulan' => $this->getPemasukanBulanIni(), 
                'tahun' => $this->getPemasukanTahunIni()
            ],
            'data_transaksi_per_bulan' => $this->getJumlahTransaksiPerBulan()
            
        ]);

    }

    public function getPemasukanBulanIni()
    {
        $pemasukan = DB::table('pembayaran')->whereMonth('tgl_bayar', now()->format("m"))->whereYear('tgl_bayar', now()->format('Y'))->sum('jumlah_masuk');
        return ['pemasukan' => [
            'bulan' => now()->isoFormat("MMMM"),
            'nilai' => $pemasukan
        ]];
    }
    public function getPemasukanTahunIni()
    {
        $pemasukan = DB::table('pembayaran')->whereYear('tgl_bayar', now()->format('Y'))->sum('jumlah_masuk');
        return ['pemasukan' => [
            'tahun' => now()->isoFormat("Y"),
            'nilai' => $pemasukan
        ]];
    }

    public function getPembayaranTerakhir()
    {
        $histori = collect(Pembayaran::latest('tgl_bayar')->with(['siswa', 'petugas'])->limit(3)->get()) ;
        $histori->each(function($h){
            $h->humanedTglBayar = $h->tgl_bayar->diffForHumans();
        });

        return $histori;
    }

    public function getJumlahTransaksiPerBulan()
    {
        $startDayOfMonth = Carbon::now()->startOfMonth()->format("d"); //1
        $currentYear = Carbon::now()->format('Y'); //2021

        $lists = [];
        for ($i=1; $i <= 12 ; $i++) {
            $lastDayOfMonth = Carbon::createFromDate(null, $i)->endOfMonth()->format("d");
            
            $transaksi = DB::table('pembayaran')->whereBetween('tgl_bayar', [
                "$currentYear-$i-$startDayOfMonth", "$currentYear-$i-$lastDayOfMonth"
            ]);
            $lists[] = [
                'uang_masuk' => $transaksi->sum('jumlah_masuk'),
                'banyak_transaksi' => $transaksi->count()
            ];
        }

        return $lists;
        //dd($lists) ;


    }
}
