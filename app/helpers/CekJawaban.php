<?php

use App\soal, App\history_pengerjaan;

function cekjawaban($kd_soal,$jawaban)
{
	$cek = soal::where('kd_soal',$kd_soal)->where('right_answer',$jawaban)->count();
	return $cek;
}

function jawaban_benar($kd_mapel,$id_siswa)
{
	return $cek = history_pengerjaan::where('kd_mapel',$kd_mapel)->where('id_siswa',$id_siswa)->where('betul_or_tidak',1)->count();
}

function jawaban_salah($kd_mapel,$id_siswa)
{
	return $cek = history_pengerjaan::where('kd_mapel',$kd_mapel)->where('id_siswa',$id_siswa)->where('betul_or_tidak',0)->count();
}

function GetScore($kd_soal)
{
	$skor = soal::findOrfail($kd_soal);
	return $skor['skor'];
}

function CekPengerjaan($value, $jawabanAnda, $jawabanBenar)
{
	$status = '';
	if($jawabanAnda == $jawabanBenar && $value == $jawabanAnda){
		$status = 'text-success';
	}elseif($jawabanAnda != $jawabanBenar && $value == $jawabanAnda){
		$status = 'text-danger';
	}
	return $status;
}