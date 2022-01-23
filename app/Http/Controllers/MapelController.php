<?php

namespace App\Http\Controllers;

use App\mapel, App\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MapelController extends Controller
{
    public function getKelas($id)
    {
    	$kls = kelas::findOrfail($id);
    	return $kls;
    }

    public function index($id)
    {
    	$mapel = mapel::join('kelas','kelas.id_kelas','=','mapels.id_kelas')
    		->where('mapels.id_kelas',$id)->get();
    	$kls = $this->getKelas($id);
    	return view('Proktor.DataMapel.index',compact('mapel','kls'));
    }

    public function create($id)
	{
		$kls = $this->getKelas($id);
		$isUpdate = false;
		$title = 'Tambah Data Mapel';
		return view('Proktor.DataMapel.formdata',compact('isUpdate','title','kls'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'nm_mapel' => 'required',
            'date_ujian' => 'required',
            'time_start' => 'required',
            'lama_ujian' => 'required'          
        ],
        [  
            'nm_mapel.required' => 'Mapel tidak boleh kosong',
            'date_ujian.required' => 'Tanggal ujian tidak boleh kosong',
            'time_start.required' => 'Waktu ujian tidak boleh kosong',
            'lama_ujian.required' => 'Lama ujian tidak boleh kosong'
        ]);

        $mapel = new mapel();
        $mapel->nm_mapel = $request->nm_mapel;
        $mapel->id_kelas = $request->id_kelas;
        $mapel->date_ujian = $request->date_ujian;
        $mapel->time_start = $request->time_start;
        $mapel->lama_ujian = $request->lama_ujian*3600;
        $mapel->save();
        return redirect('admin/mapel/'.$request->id_kelas)->with('success','Berhasil Menambahkan Data Mapel');
 	}

 	public function edit($mapel)
 	{
		$isUpdate = true;
		$title = 'Edit Data Mapel';
 		$mapel = mapel::findOrfail($mapel);
 		return view('Proktor.DataMapel.formdata',compact('isUpdate','title','mapel'));
 	}

 	public function update(Request $request, $id)
 	{
 		$request->validate([
			'nm_mapel' => 'required',
            'date_ujian' => 'required',
            'time_start' => 'required',
            'lama_ujian' => 'required'          
        ],
        [  
            'nm_mapel.required' => 'Mapel tidak boleh kosong',
            'date_ujian.required' => 'Tanggal ujian tidak boleh kosong',
            'time_start.required' => 'Waktu ujian tidak boleh kosong',
            'lama_ujian.required' => 'Lama ujian tidak boleh kosong'
        ]);

        $mapel = mapel::findOrfail($id);
        $mapel->nm_mapel = $request->nm_mapel;
        $mapel->id_kelas = $request->id_kelas;
        $mapel->date_ujian = $request->date_ujian;
        $mapel->time_start = $request->time_start;
        $mapel->lama_ujian = $request->lama_ujian*3600;
        $mapel->save();
 		return redirect('admin/mapel/'.$request->id_kelas)->with('success','Berhasil Mengubah Data Mapel');
 	}

 	public function delete($id,$kls)
 	{
        try {
            $mapel = mapel::where('kd_mapel',$id)->delete();
		} 
	   	catch (\Illuminate\Database\QueryException $e) {
	    	if($e->getCode() == "23000"){
				return back()->with('error','Gagal hapus data mapel, Dikarenakan masih ada data soal yang belum dihapus!');
			}
		}
 		return redirect('admin/mapel/'.$kls)->with('success','Berhasil Menghapus Data Mapel');
 	}
}
