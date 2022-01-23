<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesiSiswaController extends Controller
{
    public function index($kls)
    {
        $kls = \App\kelas::findOrfail($kls);
        $sesi = \App\sesiujian::all();
        return view('Proktor.DataSesi.ListSesi',compact('sesi','kls'));
    }
    
    public function create_sesi($kls,$sesi)
    {
        $siswa = \App\siswa::where('id_kelas',$kls)
        ->whereNotIn('id_siswa',
            function($query) {
                $query->select('id_siswa')->from('sesisiswa');
            }
        )->get();
        $sesi = \App\sesiujian::findOrfail($sesi);
        return view('Proktor.DataSesi.addSesi',compact('sesi','siswa'));
    }

    public function store(Request $request)
    {
        $siswa = $request->input('id_siswa');
        foreach($siswa as $key => $dtsiswa){
            $sesi = new \App\SesiSiswa();
            $sesi->id_siswa = $dtsiswa;
            $sesi->id_sesi = $request->id_sesi;
            $sesi->save();
        }
        return back()->with('success','Data sesi berhasil ditambahkan silahkan cek di data siswa.');
    }

    public function destroy_sesi($kls, $sesi)
    {
        $siswa = \App\SesiSiswa::join('siswas','siswas.id_siswa','=','sesisiswa.id_siswa')
            ->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
            ->where('sesisiswa.id_sesi',$sesi)
            ->where('siswas.id_kelas',$kls)->delete();
        return back()->with('success','Data sesi berhasil dihapus.');
    }
}
