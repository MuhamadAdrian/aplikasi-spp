<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaStoreRequest;
use App\Http\Requests\SiswaUpdateRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $siswa;

    private $kelas;

    private $spp;

    public function __construct()
    {
        $this->kelas = Kelas::all();
        $this->spp = Spp::all();
    }

    public function index(Request $request)
    {
        return Inertia::render('Siswa/Index', [
            'siswa' => Siswa::when($request->search, function($query, $search){
                $query->where('nama', 'LIKE', '%'.$search.'%');
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
        return Inertia::render('Siswa/Tambah', [
            'kelas' => $this->kelas,
            'spp' => $this->spp,
            'id_kelas' => $request->id_kelas ? $request->id_kelas : null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaStoreRequest $request)
    {
        $request->validated();

        $siswa = Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp
        ]);

        if ($siswa && $request->create_account) {
            $username = $request->nis . '@spp';
            $siswa->user()->create([
                'name' => $request->nama,
                'username' => $username,
                'password' => Hash::make($request->nis),
                'nisn_siswa' => $request->nisn,
                'role' => 'siswa'
            ]);
            return Redirect::route('siswa')->with('toast', [
                'message' => 'Data dan akun siswa berhasil ditambahkan', 
                'success' => true
            ]);
        }
        return Redirect::route('siswa.tambah')->with('toast', [
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
    public function show($nisn)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  
     * @return \Illuminate\Http\Response
     */
    public function edit($nisn)
    {
        return Inertia::render('Siswa/Edit', [
            'data' => Siswa::findOrFail($nisn),
            'kelas' => $this->kelas,
            'spp' => $this->spp,
        ]);
    }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiswaUpdateRequest $request, $nisn)
    {
        $request->validated();

        $updated = Siswa::where('nisn', $nisn)->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp,
        ]);

        if ($updated) {
            $this->siswa = Siswa::where('nisn', $request->nisn)->firstOrFail();

            $this->siswa->user()->update([
                'name' => $request->nama,
                'username' => $request->nis.'@spp',
                'password' => Hash::make($request->nis)
            ]);

            return Redirect::route('siswa')->with('toast', [
                'message' => 'Data berhasil diubah', 
                'success' => true
            ]);
        }

        return Redirect::route('data-siswa.edit', $this->siswa->nisn)->with('toast', [
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
    public function destroy($nisn)
    {
        Siswa::findOrFail($nisn)->delete();

        return Redirect::route('siswa')->with('toast', [
            'message' => 'Data dan akun siswa berhasil dihapus', 
            'success' => true
        ]);
    }
}
