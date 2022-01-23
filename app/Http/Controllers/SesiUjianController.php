<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesiUjianController extends Controller
{
    public function index()
    {
        $sesi = \App\sesiujian::all();
        return view('Proktor.DataSesi.index',compact('sesi'));
    }

    public function create()
    {
        $isUpdate = false;
		$title = 'Tambah Data Sesi Ujian';
		return view('Proktor.DataSesi.formdata',compact('isUpdate','title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi_name' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required'        
        ],
        [  
            'sesi_name.required' => 'Sesi Ujian tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'waktu.required' => 'Waktu tidak boleh kosong'
        ]);

        $sesi = new \App\sesiujian();
        $sesi->sesi_name = $request->sesi_name;
        $sesi->tanggal = $request->tanggal;
        $sesi->waktu = $request->waktu;
        $sesi->save();
        return redirect('admin/sesi_ujian')->with('success','Berhasil Menambahkan Data Sesi Ujian');
    }

    public function show($id)
    {
        $sesi = \App\sesiujian::findOrfail($id);
        $isUpdate = true;
		$title = 'Edit Data Sesi Ujian';
		return view('Proktor.DataSesi.formdata',compact('sesi','isUpdate','title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sesi_name' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required'        
        ],
        [  
            'sesi_name.required' => 'Sesi Ujian tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'waktu.required' => 'Waktu tidak boleh kosong'
        ]);

        $sesi = \App\sesiujian::findOrfail($id);
        $sesi->sesi_name = $request->sesi_name;
        $sesi->tanggal = $request->tanggal;
        $sesi->waktu = $request->waktu;
        $sesi->save();
        return redirect('admin/sesi_ujian')->with('success','Berhasil Mengubah Data Sesi Ujian');
    }

    public function destroy($id)
    {
        $sesi = \App\sesiujian::findOrfail($id);
        $sesi->delete();
        return redirect('admin/sesi_ujian')->with('success','Berhasil Menghapus Data Sesi Ujian');
    }
}
