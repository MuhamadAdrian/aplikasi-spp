<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Pembayaran/Index', [
            'siswa' => Siswa::when($request->search, function($query, $search){
                $query->where('nama', 'LIKE', '%'.$search.'%')
                ->orWhere('nisn', 'LIKE', '%'.$search.'%')
                ->orWhere('nis', 'LIKE', '%'.$search.'%');
            })->with('kelas')->latest()->paginate(5)
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pembayaran = Pembayaran::where('nisn', $request->nisn)->with(['siswa', 'petugas', 'spp'])->paginate(5);

        foreach ($pembayaran as $p) {
            $p->tunggakan = $p->spp->nominal - $p->jumlah_dibayar;
        }

        return Inertia::render('Pembayaran/Tambah', [
            'data' => [
                'siswa' => Siswa::where('nisn', $request->nisn)->with("kelas")->with('spp')->first(),
            ],

            'historiPembayaran' => $pembayaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Pembayaran::where('nisn', $request->nisn)
        ->where('bulan_dibayar', '=', $request->bulan_bayar)
        ->where('tahun_dibayar', '=', $request->tahun_bayar)
        ->exists() == true) 
        {
            dd("Oppps data sudah ada");
            return;
        }

        Pembayaran::create([
            'id_petugas' => auth()->user()->petugas->id,
            'nisn' => $request->nisn,
            'tgl_bayar' => now(),
            'bulan_dibayar' => $request->bulan_bayar,
            'tahun_dibayar' => $request->tahun_bayar,
            'id_spp' => $request->id_spp,
            'jumlah_dibayar' => $request->jumlah_bayar
        ]);

        return Redirect::route('pembayaran.tambah', ['nisn' => $request->nisn])->with('toast', [
            'message' => 'Data Pembayaran Berhasil ditambahkan', 
            'success' => true
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    


    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }
}

