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
        ->limit(3)
        ->get();

        foreach ($pembayaran as $p) {
            $p->tunggakan = $p->spp->nominal - $p->jumlah_dibayar;
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
        try{
            if (Pembayaran::where('nisn', $request->nisn)
            ->where('bulan_dibayar', $request->bulan_bayar)
            ->where('tahun_dibayar', $request->tahun_bayar)
            ->exists() == true) 
            {
                return redirect()->back()->with('toast', [
                    'message' => "Siswa ini telah membayar untuk bulan $request->bulan_bayar $request->tahun_bayar",
                    'success' => false
                ]);
            }
    
            $request->validate([
                'nisn' => 'required',
                'bulan_bayar' => 'required|string',
                'tahun_bayar' => 'required|string',
                'id_spp' => 'required',
                'jumlah_bayar' => 'required|integer'
            ]);
            
            Pembayaran::create([
                'id_petugas' => auth()->user()->petugas->id,
                'nisn' => $request->nisn,
                'bulan_dibayar' => $request->bulan_bayar,
                'tahun_dibayar' => $request->tahun_bayar,
                'id_spp' => $request->id_spp,
                'jumlah_dibayar' => $request->jumlah_bayar
            ]);
    
            return Redirect::route('histori.show', $request->nisn)->with('toast', [
                'message' => 'Data Pembayaran Berhasil ditambahkan', 
                'success' => true
            ]);
        }catch(\Throwable $th){
            return Redirect::route('pembayaran.tambah', ['nisn' => $request->nisn])->with('toast', [
               'message' => 'Pastikan Siswa ini memiliki tahun spp yang telah diinput sebelumnya', 
               'success' => false
            ]);
        }
    }
    

    public function show($id)
    {

    }
    

    public function edit($id)
    {

    }
        

    public function update(Request $request, $id)
    {
        
    }
    

    public function destroy($id)
    {
       
    }
}

