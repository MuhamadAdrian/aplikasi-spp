<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetugasStoreRequest;
use App\Http\Requests\PetugasUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $petugas;

    public function index(Request $request)
    {
        return Inertia::render('Petugas/Index', [
            'petugas' => Petugas::when($request->search, function($query, $search){
                $query->where('nama_petugas', 'LIKE', '%'.$search.'%');
            })->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Petugas/Tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetugasStoreRequest $request)
    {
        $request->validated();

        $petugas = Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $request->level 
        ]);

        if ($petugas && $request->create_account) {
            $username = $request->username . '@spp';
            $petugas->user()->create([
                'name' => $request->nama_petugas,
                'username' => $username,
                'password' => Hash::make($request->password),
                'id_petugas' => $petugas->id,
                'role' => 'petugas'
            ]);
            return Redirect::route('petugas')->with('toast', [
                'message' => 'Data dan akun petugas berhasil ditambahkan', 
                'success' => true
            ]);
        }
        return Redirect::route('petugas.tambah')->with('toast', [
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
        return Inertia::render('Petugas/Edit', [
            'data' => Petugas::findOrFail($id),
        ]);
    }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasUpdateRequest $request, $id)
    {
        $request->validated();

        $updated = Petugas::where('id', $id)->update([
            'nama_petugas' => $request->nama_petugas,
            'username' => $request->username,
            'password' => $request->password,
            'level' => $request->level
        ]);

        if ($updated) {
            $this->petugas = Petugas::where('id', $id)->firstOrFail();

            $this->petugas->user()->update([
                'name' => $request->nama_petugas,
                'username' => $request->username.'@spp',
                'password' => Hash::make($request->password),
                'role' => $request->level
            ]);

            return Redirect::route('petugas')->with('toast', [
                'message' => 'Data berhasil diubah', 
                'success' => true
            ]);
        }


        return Redirect::route('data-petugas.edit', $id)->with('toast', [
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
        Petugas::findOrFail($id)->delete();

        return Redirect::route('petugas')->with('toast', [
            'message' => 'Data kelas berhasil dihapus', 
            'success' => true
        ]);
    }
}

