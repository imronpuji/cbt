<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->bigIncrements('id_nilai');
            $table->bigInteger('id_siswa')->unsigned();
            $table->bigInteger('kd_mapel')->unsigned();
            $table->integer('jumlah_jawaban_benar');
            $table->integer('jumlah_jawaban_salah');
            $table->double('nilai');
            $table->time('waktu_mulai');
            $table->time('waktu_akhir');
            $table->timestamps();

            $table->foreign('kd_mapel')->references('kd_mapel')->on('mapels')->onDelete('restrict');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
