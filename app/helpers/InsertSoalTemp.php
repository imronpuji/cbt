<?php

use App\soal, App\soalTemp;
use Illuminate\Support\Facades\Session;

function  InsertSoalToTemp($kd_mapel)
{
	$soal = soal::where('kd_mapel',$kd_mapel)->inRandomOrder()->get();
	$no = 0;
	foreach ($soal as $data) {
		$no++;
		$soaltemp =  new soalTemp();
		$soaltemp->id_siswa = Session::get('id_siswa');
		$soaltemp->kd_mapel = $data->kd_mapel;
		$soaltemp->kd_soal = $data->kd_soal;
		$soaltemp->nomor_soal = $no;
		$soaltemp->save();
	}
	return true;
}