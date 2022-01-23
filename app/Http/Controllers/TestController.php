<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\mapel, App\start_ujian, App\soal, App\history_pengerjaan, App\nilai, App\soalTemp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    public function welcome()
    {
    	$kls = Session::get('id_kelas');
    	$now = Carbon::parse(Carbon::now())->format('Y-m-d');
    	$mapel = mapel::where('date_ujian',$now)
    		->where('id_kelas',$kls)->get();
    	return view('Siswa.Welcome.index',compact('mapel'));
    }

    public function detail_ujian($mapel)
    {
    	$detail = mapel::findOrfail($mapel);
    	return view('Siswa.StartUjian.index',compact('detail'));
    }

    public function start_ujian(Request $request)
    {
    	$lm_ujian = $request->lm_ujian;
    	$time_end = strtotime(date('H:i:s')) + $lm_ujian;
    	$start = new start_ujian();
    	$start->id_siswa = Session::get('id_siswa');
    	$start->kd_mapel = $request->id;
    	$start->time_start = Carbon::parse(Carbon::now())->format('H:i:s');
    	$start->time_end = date('H:i:s',$time_end);
    	$start->is_active = '1';
    	$start->save();
        InsertSoalToTemp($request->id);
        $getSoal = soalTemp::where('kd_mapel',$request->id)
            ->where('id_siswa',Session::get('id_siswa'))
            ->orderBy('nomor_soal','ASC')->first();
    	echo json_encode(array('response' => TRUE, 
            'kd_mapel' => $getSoal['kd_mapel'],
            'no_soal' => $getSoal['nomor_soal']
        ));
    }

    public function getSoal($kd_mapel,$no_soal)
    {
    	$soal = soal::join('soal_temps','soal_temps.kd_soal','=','soals.kd_soal')
            ->where('soals.kd_mapel',$kd_mapel)->where('soal_temps.nomor_soal',$no_soal)->first();
        $daftarSoal = soal::join('soal_temps','soal_temps.kd_soal','=','soals.kd_soal')
            ->where('soal_temps.id_siswa',Session::get('id_siswa'))
            ->where('soals.kd_mapel',$kd_mapel)->get();
        $pengerjaan = start_ujian::where('id_siswa',Session::get('id_siswa'))
            ->where('kd_mapel',$kd_mapel)->first();
    	return view('Siswa.Test.index',compact('soal','pengerjaan','daftarSoal'));
    }

    public function simpanSoal(Request $request)
    {
        if(cekSdhJawabSoal($request->kd_soal,Session::get('id_siswa')) == 1){
           $getIDhis = history_pengerjaan::where('kd_soal',$request->kd_soal)->where('id_siswa',Session::get('id_siswa'))->first();
            $hisPengerjaan = history_pengerjaan::findOrfail($getIDhis['id_his']);
        }else{
            $hisPengerjaan = new history_pengerjaan();
        } 
        $hisPengerjaan->kd_mapel = $request->kd_mapel;
        $hisPengerjaan->kd_soal = $request->kd_soal;
        $hisPengerjaan->id_siswa = Session::get('id_siswa');
        $hisPengerjaan->your_answer = $request->answer;
        $hisPengerjaan->betul_or_tidak = cekjawaban($request->kd_soal,$request->answer);
        $hisPengerjaan->yakin_or_not = $request->kondisi;
        $hisPengerjaan->save();
        echo json_encode(true);
    }

    public function konfirmasi($id)
    {
        $mapel = start_ujian::where('kd_mapel',$id)->where('id_siswa',Session::get('id_siswa'))->first();
        return view('Siswa.Konfirmasi.index',compact('mapel'));
    }

    public function finish(Request $request)
    {      
        $dataWaktu = start_ujian::where('kd_mapel',$request->kd_mapel)
            ->where('id_siswa',Session::get('id_siswa'))->first();

        $getSkor = history_pengerjaan::where('kd_mapel',$request->kd_mapel)
            ->where('id_siswa',Session::get('id_siswa'))
            ->where('betul_or_tidak',1)->get();
        $skorAkhir = 0;
        foreach ($getSkor as $skor) {
            $soalSkor = soal::findOrfail($skor->kd_soal);
            $skorAkhir = $skorAkhir + $soalSkor['skor'];
        }
        $nilai = new nilai();
        $nilai->id_siswa = Session::get('id_siswa');
        $nilai->kd_mapel = $request->kd_mapel;
        $nilai->jumlah_jawaban_benar = jawaban_benar(
            $request->kd_mapel,
            Session::get('id_siswa')
        );
        $nilai->jumlah_jawaban_salah = jawaban_salah(
            $request->kd_mapel,
            Session::get('id_siswa')
        );
        $nilai->nilai = $skorAkhir;
        $nilai->waktu_mulai = $dataWaktu['time_start'];
        $nilai->waktu_akhir = Carbon::now();
        $nilai->save();

        start_ujian::where('kd_mapel',$request->kd_mapel)
            ->where('id_siswa',Session::get('id_siswa'))->delete();
        soalTemp::where('kd_mapel',$request->kd_mapel)
            ->where('id_siswa',Session::get('id_siswa'))->delete();
        
        echo json_encode(true);
    }
}
