<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Pembayaran;
use App\Models\Spp;
use Carbon\Carbon;
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
    

    public function create(Request $request)
    {
        $pembayaran = Pembayaran::where('nisn', $request->nisn)
        ->with(['siswa', 'petugas', 'spp'])
        ->latest('tgl_bayar')
        ->limit(4)
        ->get();

        foreach ($pembayaran as $p) {
            $p->tgl_bayar = Carbon::parse($p->tgl_bayar)->isoFormat('D MMMM Y');
        }
        
        return Inertia::render('Pembayaran/Tambah', [
            'data' => [
                'siswa' => Siswa::where('nisn', $request->nisn)->with(['kelas', 'spp'])->first(),
            ],
            
            'historiPembayaran' => $pembayaran,

            'spp' => Spp::all()
        ]);
    }
        

    public function store(Request $request)
    {

            if (Pembayaran::where('nisn', $request->nisn)
            ->where('bulan_dibayar', $request->bulan_bayar)
            ->where('tahun_dibayar', $request->tahun_bayar)
            ->exists()) 
            {
                return redirect()->back()->with('toast', [
                    'message' => "Siswa ini telah membayar untuk bulan $request->bulan_bayar $request->tahun_bayar",
                    'success' => false
                ]);
            }
    
            $request->validate([
                'nisn' => 'required',
                'bulan_bayar' => 'required|string|max:9',
                'tahun_bayar' => 'required|string|max:4',
                'id_spp' => 'required',
                'jumlah_bayar' => 'required|integer',
                'jumlah_masuk' => 'required',
            ], Siswa::message);
            
            Pembayaran::create([
                'id_petugas' => auth()->user()->petugas->id,
                'nisn' => $request->nisn,
                'bulan_dibayar' => $request->bulan_bayar,
                'tahun_dibayar' => $request->tahun_bayar,
                'id_spp' => $request->id_spp,
                'jumlah_dibayar' => $request->jumlah_bayar,
                'jumlah_masuk' => $request->jumlah_masuk,
                'status' => $request->jumlah_masuk == $request->jumlah_bayar ? 'lunas' : 'belum lunas'
            ]);
    
            return Redirect::route('histori.show', $request->nisn)->with('toast', [
                'message' => 'Data Pembayaran Berhasil ditambahkan', 
                'success' => true
            ]);
    }
    

    public function show($id)
    {

    }
    

    public function edit($id)
    {

    }
        

    public function update(Request $request, $id)
    {
        Pembayaran::where('id', $id)->update([
            'jumlah_masuk' => $request->jumlah_dibayar,
            'status' => 'lunas'
        ]);

        return back()->with('toast', [
            'message' => 'Pelunasan Berhasil',
            'success' => true
        ]);
    }
    

    public function destroy($id)
    {
       
    }
}

