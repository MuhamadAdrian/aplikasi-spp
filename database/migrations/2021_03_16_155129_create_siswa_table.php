<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('nisn', 10)->primary();
            $table->string('nis', 8);
            $table->string('nama', 35);
            $table->unsignedInteger('id_kelas')->index();
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->text('alamat');
            $table->string('no_telp', 13);
            $table->unsignedInteger('id_spp')->index();
            $table->foreign('id_spp')->references('id')->on('spp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
