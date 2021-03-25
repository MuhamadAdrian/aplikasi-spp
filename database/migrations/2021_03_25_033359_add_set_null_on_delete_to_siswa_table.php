<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSetNullOnDeleteToSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropForeign('siswa_id_kelas_foreign');
            $table->dropForeign('siswa_id_spp_foreign');
            $table->foreign('id_kelas')->references('id')->on('kelas')->nullOnDelete()->change();
            $table->foreign('id_spp')->references('id')->on('spp')->nullOnDelete()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            //
        });
    }
}
