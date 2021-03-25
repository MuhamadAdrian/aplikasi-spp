<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    protected $fillable = [
        'nama_petugas', 'username', 'password', 'level'
    ];

    public $timestamps = false;

    public const message = [
        'required' => ':attribute tidak boleh kosong',
        'unique' => ':attribute sudah terdaftar, gunakan nilai lain',
        'max' => ':attribute terlalu panjang',
        'string' => ':attribute harus berupa string atau kalimat atau kata',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id_petugas', 'id');
    }
}
