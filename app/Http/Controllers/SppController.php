<?php

namespace App\Http\Controllers;

use App\Http\Requests\SppStoreRequest;
use App\Http\Requests\SppUpdateRequest;
use App\Models\Spp;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return Inertia::render('Spp/Index', [
            'spp' => Spp::when($request->search, function($query, $search){
                $query->where('tahun', 'LIKE', '%'.$search.'%');
            })->orderBy('tahun', 'desc')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Spp/Tambah', [
            'id_kelas' => $request->id_kelas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
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
        return Inertia::render('Spp/Edit', [
            'data' => Spp::findOrFail($id),
        ]);
    }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SppUpdateRequest $request, $id)
    {
        $request->validated();

        $updated = Spp::where('id', $id)->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        if ($updated) {
            return Redirect::route('spp')->with('toast', [
                'message' => 'Data berhasil diubah', 
                'success' => true
            ]);
        }
            
        return Redirect::route('data-spp.edit', $id) ->with('toast', [
            'message' => 'Tidak ada data yang dirubah', 
            'success' => false
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Spp::findOrFail($id)->delete();

            return Redirect::route('spp')->with('toast', [
                'message' => 'Data spp berhasil dihapus', 
                'success' => true
            ]);
        }catch(Throwable $error){
            return redirect()->back()->with('toast', [
                'message' => 'Maaf spp sedang digunakan',
                'success' => false
            ]);
        }
    }
}
