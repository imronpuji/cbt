<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->bigIncrements('kd_soal');
            $table->longText('soal')->nullable();
            $table->string('soal_file')->nullable();
            $table->mediumText('option_1')->nullable();
            $table->mediumText('option_2')->nullable();
            $table->mediumText('option_3')->nullable();
            $table->mediumText('option_4')->nullable();
            $table->mediumText('option_5')->nullable();
            $table->longText('right_answer');
            $table->longText('pembahasan');
            $table->double('skor');
            $table->bigInteger('kd_mapel')->unsigned();
            $table->bigInteger('id_kelas')->unsigned();
            $table->timestamps();

            $table->foreign('kd_mapel')->references('kd_mapel')->on('mapels')->onDelete('restrict');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soals');
    }
}
