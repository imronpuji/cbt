<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_temps', function (Blueprint $table) {
            $table->bigIncrements('kd_soaltemp');
            $table->bigInteger('id_siswa')->unsigned();
            $table->bigInteger('kd_mapel')->unsigned();
            $table->bigInteger('kd_soal')->unsigned();
            $table->integer('nomor_soal');
            $table->timestamps();
            $table->foreign('kd_mapel')->references('kd_mapel')->on('mapels')->onDelete('restrict');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('restrict');
            $table->foreign('kd_soal')->references('kd_soal')->on('soals')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_temps');
    }
}
