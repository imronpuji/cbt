<?php

use App\soal;

function getNomorSoal($mapel)
{
	$nomorSoal = soal::where('kd_mapel',$mapel)->count();
	$nomorSoal++;
	$ulang = true;
	do {
		$cekNomorSoal = soal::where('kd_mapel',$mapel)->where('nomor_soal',$nomorSoal)->count();
		if($cekNomorSoal == 0){
			$ulang = false;
		}else{
			$nomorSoal++;
		}
	} while ($ulang);
	return $nomorSoal;
}