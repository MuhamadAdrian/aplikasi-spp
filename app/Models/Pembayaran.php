<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'id_petugas', 'nisn', 'tgl_bayar', 'bulan_bayar', 'tahub_bayar', 'id_spp', 'jumlah_bayar'
    ];

    public $timestamps = false;
}
