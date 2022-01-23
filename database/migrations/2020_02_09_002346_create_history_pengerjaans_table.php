<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPengerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_pengerjaans', function (Blueprint $table) {
            $table->bigIncrements('id_his');
            $table->bigInteger('kd_mapel')->unsigned();
            $table->bigInteger('kd_soal')->unsigned();
            $table->bigInteger('id_siswa')->unsigned();
            $table->longText('your_answer');
            $table->boolean('betul_or_tidak');
            $table->boolean('yakin_or_not');
            $table->timestamps();

            $table->foreign('kd_mapel')->references('kd_mapel')->on('soals')->onDelete('restrict');
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
        Schema::dropIfExists('history_pengerjaans');
    }
}
