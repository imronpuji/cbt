<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('start_ujians', function (Blueprint $table) {
            $table->bigIncrements('id_start');
            $table->bigInteger('id_siswa')->unsigned();
            $table->bigInteger('kd_mapel')->unsigned();
            $table->time('time_start');
            $table->time('time_end');
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('start_ujians');
    }
}
