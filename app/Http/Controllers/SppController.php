<?php

namespace App\Http\Controllers;

use App\Http\Requests\SppStoreRequest;
use App\Http\Requests\SppUpdateRequest;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class SppController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Spp/Index', [
            'spp' => Spp::when($request->search, function($query, $search){
                $query->where('tahun', 'LIKE', '%'.$search.'%');
            })->orderBy('tahun', 'desc')->paginate(10)
        ]);
    }


    public function create(Request $request)
    {
        return Inertia::render('Spp/Tambah', [
            'id_kelas' => $request->id_kelas
        ]);
    }


    public function store(SppStoreRequest $request)
    {
        $request->validated();

        $spp = Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        if ($spp) 
        {
            return Redirect::route('spp')->with('toast', [
                'message' => 'Data berhasil ditambahkan', 
                'success' => true
            ]);
        }

        return Redirect::route('spp.tambah')->with('toast', [
            'message' => 'Maaf terjadi kesalahan', 
            'success' => false
        ]);
    }
    

    public function show(Request $request, $id)
    {
    }
    

    public function edit($id)
    {
        return Inertia::render('Spp/Edit', [
            'data' => Spp::findOrFail($id),
        ]);
    }
        

    public function update(SppUpdateRequest $request, $id)
    {
        $request->validated();

        Spp::where('id', $id)->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return Redirect::route('spp')->with('toast', [
            'message' => 'Data berhasil diubah', 
            'success' => true
        ]);
    }
    

    public function destroy($id)
    {
        try{
            Spp::findOrFail($id)->delete();

            return Redirect::route('spp')->with('toast', [
                'message' => 'Data spp berhasil dihapus', 
                'success' => true
            ]);
        }catch(Throwable $error){
            if ($error->getCode() == 23000) {
                return redirect()->back()->with('toast', [
                   'message' => 'Maaf spp sedang digunakan',
                   'success' => false
                ]);
            }
        }
    }
}
