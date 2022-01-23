<?php

namespace App\Http\Controllers;

use App\nilai, App\mapel, App\kelas, App\siswa, App\history_pengerjaan;
use PDF;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NilaiController extends Controller
{
    public function index($id)
    {
    	$kls = kelas::where('id_kelas',$id)->first();
    	$mapel = mapel::where('id_kelas',$id)->get();
    	return view('Proktor.DataNilai.index',compact('mapel','kls'));
    }

    public function getNilai($kd_mapel,$kelas)
    {
    	$kls = kelas::where('id_kelas',$kelas)->first();
    	$mapel = mapel::where('kd_mapel',$kd_mapel)->first();
    	$nilai = nilai::join('siswas','siswas.id_siswa','=','nilais.id_siswa')->where('nilais.kd_mapel',$kd_mapel)->get();
  		return view('Proktor.DataNilai.ListNilaiPerMapel',compact('nilai','mapel','kls'));
    }

    public function PengerjaanSoal($kd_mapel,$id_siswa)
    {
    	$mapel = mapel::where('kd_mapel',$kd_mapel)->first();
    	$nilai = nilai::where('kd_mapel',$kd_mapel)->where('id_siswa',$id_siswa)->first();
    	$siswakelas = siswa::join('kelas','kelas.id_kelas','=','siswas.id_kelas')->where('id_siswa',$id_siswa)->first();
    	$pengerjaan = history_pengerjaan::join('siswas','siswas.id_siswa','=','history_pengerjaans.id_siswa')->join('soals','soals.kd_soal','=','history_pengerjaans.kd_soal')
    		->where('history_pengerjaans.id_siswa',$id_siswa)
    		->where('history_pengerjaans.kd_mapel',$kd_mapel)->get();
  		return view('Proktor.DataNilai.DetailPengerjaan',compact('pengerjaan','mapel','siswakelas','nilai'));
    }

    public function  hapus_nilai($mapel,$id_siswa)
    {
        history_pengerjaan::where('kd_mapel',$mapel)->where('id_siswa',$id_siswa)->delete();
        nilai::where('kd_mapel',$mapel)->where('id_siswa',$id_siswa)->delete();
        return back()->with('success','Berhasil Menghapus Nilai');
    }

    public function hapus_semua_nilai($mapel)
    {
        history_pengerjaan::where('kd_mapel',$mapel)->delete();
        nilai::where('kd_mapel',$mapel)->delete();
        return back()->with('success','Berhasil Menghapus Nilai');
    }

    public function export_nilai(Request $request)
    {
        return Excel::download(new NilaiExport($request->kd_mapel),'Data Nilai.xlsx');
    }
}
