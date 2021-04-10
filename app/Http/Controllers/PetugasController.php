<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetugasStoreRequest;
use App\Http\Requests\PetugasUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PetugasController extends Controller
{

    public $petugas;

    public function index(Request $request)
    {
        return Inertia::render('Petugas/Index', [
            'petugas' => Petugas::when($request->search, function($query, $search){
                $query->where('nama_petugas', 'LIKE', '%'.$search.'%');//for mysql
                //$query->where('nama_petugas', 'ILIKE', '%'.$search.'%');//for postgress
            })->paginate(10)
        ]);
    }


    public function create()
    {
        return Inertia::render('Petugas/Tambah');
    }


    public function store(PetugasStoreRequest $request)
    {
        $request->validated();

        if ($request->create_account) {
            DB::transaction(function () use($request) {                
                $petugas = Petugas::create([
                    'nama_petugas' => $request->nama_petugas,
                    'username' => $request->username,
                    'password' => $request->password,
                    'level' => $request->level 
                ]);

                $username = $request->username . '@spp';
                $petugas->user()->create([
                    'name' => $request->nama_petugas,
                    'username' => $username,
                    'password' => Hash::make($request->password),
                    'id_petugas' => $petugas->id,
                    'role' => 'petugas'
                ]);
            });
        }
        return Redirect::route('petugas')->with('toast', [
            'message' => 'Data dan akun petugas berhasil ditambahkan', 
            'success' => true
        ]);
    }
    

    public function edit($id)
    {
        return Inertia::render('Petugas/Edit', [
            'data' => Petugas::findOrFail($id),
        ]);
    }
        

    public function update(PetugasUpdateRequest $request, $id)
    {
        $request->validated();
        
        DB::transaction(function () use($request, $id) {            
            Petugas::where('id', $id)->update([
                'nama_petugas' => $request->nama_petugas,
                'username' => $request->username,
                'password' => $request->password,
                'level' => $request->level
            ]);

            $this->petugas = Petugas::where('id', $id)->firstOrFail();

            $this->petugas->user()->update([
                'name' => $request->nama_petugas,
                'username' => $request->username.'@spp',
                'password' => Hash::make($request->password),
                'role' => $request->level
            ]);
        });

        return Redirect::route('petugas')->with('toast', [
            'message' => 'Data berhasil diubah', 
            'success' => true
        ]);
    }
    

    public function destroy($id)
    {
        try {
            Petugas::findOrFail($id)->delete();
    
            return Redirect::route('petugas')->with('toast', [
                'message' => 'Data kelas berhasil dihapus', 
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('toast', [
                'message' => 'Pastikan tidak ada transaksi yang dilakukan oleh petugas ini', 
                'success' => false
            ]);
        }
    }
}

