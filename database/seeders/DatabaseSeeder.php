<?php

namespace Database\Seeders;

use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /*for ($i=1; $i <=35 ; $i++) { 
            $siswa = Siswa::factory()->create([
                'id_kelas' => 12,
                'id_spp' => 2
            ]);
    
            User::factory()->create([
                'name' => $siswa->nama,
                'username' => $siswa->nis.'@spp',
                'password' => bcrypt($siswa->nis),
                'nisn_siswa' => $siswa->nisn,
                'role' => 'siswa'
            ]);
        }*/

        $petugas = Petugas::factory()->create();

        User::factory()->create([
            'name' => $petugas->nama_petugas,
            'username' => $petugas->username.'@spp',
            'password' => bcrypt($petugas->password),
            'role' => $petugas->level,
            'id_petugas' => $petugas->id
        ]);

    }
}
