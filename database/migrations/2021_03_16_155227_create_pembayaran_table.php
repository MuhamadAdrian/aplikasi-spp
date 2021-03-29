<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_petugas')->index();
            $table->foreign('id_petugas')->references('id')->on('petugas')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('nisn', 10)->index();
            $table->foreign('nisn')->references('nisn')->on('siswa')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('tgl_bayar');
            $table->string('bulan_dibayar', 9);
            $table->string('tahun_dibayar', 4);
            $table->unsignedInteger('id_spp')->index();
            $table->foreign('id_spp')->references('id_spp')->on('siswa')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah_dibayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
