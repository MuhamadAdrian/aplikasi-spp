<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Inertia\Inertia;

class HistoriController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['spp', 'petugas', 'siswa'])->latest('tgl_bayar')->paginate(5);
        foreach ($pembayaran->items() as $p) {
            $p->tgl_bayar = Carbon::parse($p->tgl_bayar)->isoFormat('D MMMM Y');
        }
        return Inertia::render('Histori/Index', [
            'histori' => $pembayaran
        ]);
    }

    public function show($nisn)
    {
        return Inertia::render('Histori/Detail', [
            'detail' => Pembayaran::with(['siswa', 'petugas', 'spp'])->where('nisn', $nisn)->latest('tgl_bayar')->paginate(5)
        ]);
    }
}

