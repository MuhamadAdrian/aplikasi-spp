<?php

namespace App\Models;

use App\Http\Controllers\PembayaranController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $fillable = [
        'tahun', 'nominal'
    ];

    public $timestamps = false;

    public const message = [
        'required' => ':attribute tidak boleh kosong',
        'unique' => ':attribute sudah terdaftar, gunakan nilai lain',
        'integer' => ':attribute harus berupa angka',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_spp','id');
    }
}
