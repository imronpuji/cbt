<?php

use App\soal;

function getJumlahSoal($kd_mapel)
{
	return $jumlah_soal = soal::where('kd_mapel',$kd_mapel)->count();
}