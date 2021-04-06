<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas', 'kompetensi_keahlian'
    ];

    public const message = [
        'required' => ':attribute tidak boleh kosong',
        'unique' => ':attribute sudah terdaftar, gunakan nilai lain',
        'max' => ':attribute terlalu panjang',
        'string' => ':attribute harus berupa string atau kalimat atau kata',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id');
    }

}
