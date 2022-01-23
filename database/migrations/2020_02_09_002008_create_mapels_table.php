<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapels', function (Blueprint $table) {
            $table->bigIncrements('kd_mapel');
            $table->string('nm_mapel',80);
            $table->bigInteger('id_kelas')->unsigned();
            $table->date('date_ujian')->nullable();
            $table->time('time_start')->default('00:00:00')->nullable();
            $table->integer('lama_ujian')->nullable();
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
        Schema::dropIfExists('mapels');
    }
}
