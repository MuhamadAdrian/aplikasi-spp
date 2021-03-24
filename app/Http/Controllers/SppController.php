<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasStoreRequest;
use App\Http\Requests\KelasUpdateRequest;
use App\Models\Spp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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
                $query->where('nama_kelas', 'LIKE', '%'.$search.'%');
            })->paginate(5)
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
    public function store(KelasStoreRequest $request)
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
        $detail = Spp::with('siswa')->find($id);

        $detail->setRelation('siswa', $detail->siswa()->with('kelas')->where('nama', 'LIKE', '%'.$request->search.'%')->paginate(5));
        
        return Inertia::render('Spp/Detail', [
            'detail' => $detail
        ]);


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
    public function update(KelasUpdateRequest $request, $id)
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

        return Redirect::route('spp.edit', $id)->with('toast', [
            'message' => 'Mohon maaf terjadi kesalahan, silahkan mencoba kembali', 
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
        Spp::findOrFail($id)->delete();

        return Redirect::route('spp')->with('toast', [
            'message' => 'Data spp berhasil dihapus', 
            'success' => true
        ]);
    }
}
