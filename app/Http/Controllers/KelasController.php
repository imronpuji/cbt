<?php

namespace App\Http\Controllers;

use App\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function index()
    {
    	$data = kelas::all();
    	return view('Proktor.DataKelas.index',compact('data'));
    }

    public function create()
	{
		$isUpdate = false;
		$title = 'Tambah Data Kelas';
		return view('Proktor.DataKelas.formdata',compact('isUpdate','title'));
	}

	public function store(Request $request)
	{
		$request->validate([
            'nm_kelas' => 'required'          
        ],
        [  
            'nm_kelas.required' => 'Nama Kelas tidak boleh kosong'
        ]);

        $kelas = new kelas();
        $kelas->nm_kelas = $request->nm_kelas;
        $kelas->save();
        return redirect('admin/kelas')->with('success','Berhasil Menambahkan Data Kelas');
 	}

 	public function edit($id)
 	{
 		$isUpdate = true;
		$title = 'Tambah Data Kelas';
 		$kelas = kelas::findOrfail($id);
 		return view('Proktor.DataKelas.formdata',compact('isUpdate','title','kelas'));
 	}

 	public function update(Request $request, $id)
 	{
 		$request->validate([
            'nm_kelas' => 'required'          
        ],
        [  
            'nm_kelas.required' => 'Nama Kelas tidak boleh kosong'
        ]);

 		$kelas = kelas::findOrfail($id);
 		$kelas->nm_kelas = $request->nm_kelas;
 		$kelas->save();
 		return redirect('admin/kelas')->with('success','Berhasil Mengubah Data Kelas');
 	}

 	public function delete($id)
 	{
		try {
			$kelas = kelas::where('id_kelas',$id)->delete();
		} 
	   	catch (\Illuminate\Database\QueryException $e) {
	    	if($e->getCode() == "23000"){
				return back()->with('error','Gagal hapus data kelas, Dikarenakan masih ada data siswa');
			}
		}
		return redirect('admin/kelas')->with('success','Berhasil Menghapus Data Kelas');
 	}
}
