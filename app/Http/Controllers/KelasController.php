<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasStoreRequest;
use App\Http\Requests\KelasUpdateRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Kelas/Index', [
            'kelas' => Kelas::when($request->search, function($query, $search){
                $query->where('nama_kelas', 'LIKE', '%'.$search.'%');
            })->paginate(10)
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Kelas/Tambah', [
            'id_kelas' => $request->id_kelas
        ]);
    }

    public function store(KelasStoreRequest $request)
    {
        $request->validated();

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        if ($kelas) 
        {
            return Redirect::route('kelas')->with('toast', [
                'message' => 'Data kelas berhasil ditambahkan', 
                'success' => true
            ]);
        }

        return Redirect::route('kelas.tambah')->with('toast', [
            'message' => 'Maaf terjadi kesalahan', 
            'success' => false
        ]);
    }
    
    public function show(Request $request, $id)
    {
        $detail = Kelas::with('siswa')->find($id);

        if ($request->search) 
        {
            $detail->setRelation('siswa', 
                $detail->siswa()->with('kelas')->where('nama', 'LIKE', '%'.$request->search.'%')
                ->orWhere('nisn', 'LIKE', '%'.$request->search.'%')
                ->orWhere('nis', 'LIKE', '%'.$request->search.'%')
                ->paginate(10)
            );
        }
        else{
            $detail->setRelation('siswa', $detail->siswa()->with('kelas')->paginate(5));
        }
        
        return Inertia::render('Kelas/Detail', [
            'detail' => $detail,
            'jumlah_siswa' => $detail->siswa()->count()
        ]);


    }
    
    public function edit($id)
    {
        return Inertia::render('Kelas/Edit', [
            'data' => Kelas::findOrFail($id),
        ]);
    }
        
    public function update(KelasUpdateRequest $request, $id)
    {
        $request->validated();

        $updated = Kelas::where('id', $id)->update([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian,
        ]);

        if ($updated) {
            return Redirect::route('kelas')->with('toast', [
                'message' => 'Data berhasil diubah', 
                'success' => true
            ]);
        }

        return Redirect::route('kelas.edit', $id)->with('toast', [
            'message' => 'Tidak ada data yang dirubah', 
            'success' => false
        ]);

        
    }
    
    public function destroy($id)
    {
        Kelas::findOrFail($id)->delete();

        return Redirect::route('kelas')->with('toast', [
            'message' => 'Data kelas berhasil dihapus', 
            'success' => true
        ]);
    }
}
