<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nisn','nis', 'nama', 'id_kelas', 'alamat', 'no_telp', 'id_spp'
    ];

    protected $primaryKey = 'nisn';

    public $incrementing = false;

    protected $keyType = 'string';

    public const message = [
        'required' => ':attribute tidak boleh kosong',
        'unique' => ':attribute sudah terdaftar, gunakan nilai lain',
        'max' => ':attribute tidak boleh lebih dari :max',
        'string' => ':attribute harus berupa string atau kalimat',
        'integer' => ':attribute harus berupa integer atau angka',
        'min' => ':attribute setidaknya adalah :min',
    ];

    public function kelas ()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'nisn_siswa', 'nisn');
    }

    public function pembayaran()
    {
        return  $this->hasMany(Pembayaran::class, 'id_spp', 'id_spp');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp', 'id');
    }

}
