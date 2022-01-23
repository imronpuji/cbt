<?php

namespace App\Http\Controllers;

use App\kelas, App\siswa, App\mapel;
use PDF;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    public function getKelas($id)
    {
    	$kls = kelas::findOrfail($id);
    	return $kls;
    }

    public function index($id)
    {
        $siswa = siswa::leftjoin('kelas','kelas.id_kelas','=','siswas.id_kelas')
            ->leftjoin('sesisiswa','sesisiswa.id_siswa','=','siswas.id_siswa')
            ->leftjoin('sesiujian','sesiujian.id_sesi','=','sesisiswa.id_sesi')
    		->where('siswas.id_kelas',$id)->get();
    	$kls = $this->getKelas($id);
    	return view('Proktor.DataSiswa.index',compact('siswa','kls'));
    }

     public function create($id)
	{
		$kls = $this->getKelas($id);
		$allKls = kelas::all();
		$isUpdate = false;
		$title = 'Tambah Data Kelas';
		return view('Proktor.DataSiswa.formdata',compact('isUpdate','title','kls','allKls'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'nis' => 'required',
			'nama' => 'required',
            'id_kelas' => 'required',
            'password' => 'required'          
        ],
        [  
            'nis.required' => 'NIS tidak boleh kosong',
            'nama.required' => 'Nama Siswa tidak boleh kosong',
            'id_kelas.required' => 'Nama Kelas tidak boleh kosong',
            'password.required' => 'Password Siswa tidak boleh kosong'
        ]);

        $siswa = new siswa();
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->password = $request->password;
        $siswa->save();
        return redirect('admin/siswa/'.$request->id_kelas)->with('success','Berhasil Menambahkan Data Siswa');
 	}

 	public function edit($siswa)
 	{
		$allKls = kelas::all();
		$isUpdate = true;
		$title = 'Tambah Data Kelas';
 		$siswa = siswa::join('kelas','kelas.id_kelas','=','siswas.id_kelas')
   		->where('siswas.id_siswa',$siswa)->first();
 		return view('Proktor.DataSiswa.formdata',compact('isUpdate','title','siswa','allKls'));
 	}

 	public function update(Request $request, $id)
 	{
 		$request->validate([
			'nis' => 'required',
			'nama' => 'required',
            'id_kelas' => 'required',
            'password' => 'required'          
        ],
        [  
            'nis.required' => 'NIS tidak boleh kosong',
            'nama.required' => 'Nama Siswa tidak boleh kosong',
            'id_kelas.required' => 'Nama Kelas tidak boleh kosong',
            'password.required' => 'Password Siswa tidak boleh kosong'
        ]);

        $siswa = siswa::findOrfail($id);
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->password = $request->password;
        $siswa->save();
 		return redirect('admin/siswa/'.$request->id_kelas)->with('success','Berhasil Mengubah Data Siswa');
 	}

 	public function delete($id,$kls)
 	{
        try {
            $siswa = siswa::where('id_siswa',$id)->delete();
		} 
	   	catch (\Illuminate\Database\QueryException $e) {
	    	if($e->getCode() == "23000"){
                return back()->with('error','Gagal menghapus siswa tersebut dikarenakan siswa tersebut telah mengerjakan ujian & data ujian!,<br>
                Hapus nilai ujian terlebih dahulu!');
			}
        }
        return redirect('admin/siswa/'.$kls)->with('success','Berhasil Menghapus Data Siswa');
 	}

    public function clear($kls)
    {
        siswa::where('id_kelas',$kls)->delete();
        return back()->with('success','Berhasil Menkosongkan Data Siswa');
    }

    public function import_siswa()
    {
        if(Excel::import(new SiswaImport,request()->file('siswa_import'))){
            return back()->with('success','Berhasil Import Data Siswa');
        }else{
            return back()->with('error','Gagal Import Data Siswa Pastikan Format Excel Anda Sama Dengan Panduan.');
        }
        
    }

    public function export_siswa(Request $request)
    {
        return Excel::download(new SiswaExport($request->id_kelas),'Data Siswa.xlsx');
    }

    public function cetak_kartu($id_kelas)
    {
        $siswa = siswa::join('kelas','kelas.id_kelas','=','siswas.id_kelas')
            ->where('siswas.id_kelas',$id_kelas)->get();
        $mapel = mapel::join('siswas','siswas.id_kelas','=','mapels.id_kelas')
            ->join('sesisiswa','sesisiswa.id_siswa','=','siswas.id_siswa')
            ->join('sesiujian','sesiujian.id_sesi','=','sesisiswa.id_sesi')
            ->where('siswas.id_kelas',$id_kelas)->get();
        $pdf = PDF::loadview('Proktor.DataSiswa.kartu_ujian',compact('siswa','mapel'));
        return $pdf->stream();
        //return view('Proktor.DataSiswa.kartu_ujian',compact('siswa','mapel'));
    }
}
