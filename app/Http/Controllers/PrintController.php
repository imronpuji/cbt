<?php

namespace App\Http\Controllers;

use App\nilai, App\mapel, App\kelas, App\siswa, App\history_pengerjaan;
use PDF;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function CetakPengerjaan($kd_mapel,$id_siswa)
    {
        $mapel = mapel::where('kd_mapel',$kd_mapel)->first();
        $nilai = nilai::where('kd_mapel',$kd_mapel)->where('id_siswa',$id_siswa)->first();
        $siswakelas = siswa::join('kelas','kelas.id_kelas','=','siswas.id_kelas')->where('id_siswa',$id_siswa)->first();
        $pengerjaan = history_pengerjaan::join('siswas','siswas.id_siswa','=','history_pengerjaans.id_siswa')->join('soals','soals.kd_soal','=','history_pengerjaans.kd_soal')
            ->where('history_pengerjaans.id_siswa',$id_siswa)
            ->where('history_pengerjaans.kd_mapel',$kd_mapel)->get();
        $pdf = PDF::loadview('Proktor.DataNilai.PrintPengerjaanSiswa',compact('pengerjaan','mapel','siswakelas','nilai'));
        return $pdf->stream();
    }
}
