<?php

use App\history_pengerjaan, App\nilai, App\start_ujian;

function cekSdhJawabSoal($kd_soal,$id_siswa)
{
	return $cek = history_pengerjaan::where('kd_soal',$kd_soal)
		->where('id_siswa',$id_siswa)->count();
}

function CekYourAnswer($kd_soal,$id_siswa)
{
	$cek = history_pengerjaan::where('kd_soal',$kd_soal)
		->where('id_siswa',$id_siswa)->first();
	if($cek==null){
		return $cek;
	} else {
		return $cek['your_answer'];
	}
}

function CekYakin($kd_soal,$id_siswa)
{
	$cek = history_pengerjaan::where('kd_soal',$kd_soal)
		->where('id_siswa',$id_siswa)->where('yakin_or_not',1)->count();
	return $cek;
}

function CekRagu2($kd_soal,$id_siswa)
{
	$cek = history_pengerjaan::where('kd_soal',$kd_soal)
		->where('id_siswa',$id_siswa)->where('yakin_or_not',0)->count();
	return $cek;
}


function cekSudahDikerjakan($kd_mapel,$id_siswa)
{
	return $cek = nilai::where('kd_mapel',$kd_mapel)->where('id_siswa',$id_siswa)->count();
}

function cekMasihDikerjakan($kd_mapel,$id_siswa)
{
	return $cek = start_ujian::where('kd_mapel',$kd_mapel)
		->where('id_siswa',$id_siswa)
		->where('is_active',1)->count();
}