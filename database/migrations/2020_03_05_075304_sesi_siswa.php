<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SesiSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesiSiswa', function (Blueprint $table) {
            $table->bigIncrements('idSesiSiswa');
            $table->bigInteger('id_siswa')->unsigned();
            $table->bigInteger('id_sesi')->unsigned();
            $table->timestamps();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('restrict');
            $table->foreign('id_sesi')->references('id_sesi')->on('sesiUjian')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesiSiswa');
    }
}
