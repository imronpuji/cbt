<?php

namespace App\Http\Controllers;

use App\soal, App\kelas, App\mapel;
use File, PDF;
use App\Imports\SoalImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SoalController extends Controller
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
    	return view('Proktor.DataSoal.listSoal',compact('mapel','kls'));
    }

    public function soal($kls,$id)
    {
    	$soal = soal::where('kd_mapel',$id)->get();
		$kls = $this->getKelas($kls);
    	return view('Proktor.DataSoal.soal',compact('soal','kls'));
    }

     public function create($kls,$mapel)
	{
		$kls = $this->getKelas($kls);
		$isUpdate = false;
		$title = 'Tambah Data Soal';
		return view('Proktor.DataSoal.formdata',compact('isUpdate','title','kls'));
	}

	public function store(Request $request)
	{
        $soal = new soal();
        $soal->soal = $request->soal;
        if(!empty($request->soal_file)){
        	$soal->soal_file = $request->soal_file->getClientOriginalName();
        	$request->soal_file->move(public_path('files/file_soal'), $soal->soal_file);
        }

        if(!empty($request->option_img1)){
            $img1 = $request->option_img1->getClientOriginalName();
            $request->option_img1->move(public_path('files/gambar_jawaban'), $img1);
        	$soal->option_1 = $img1;       	
        }else {
            $soal->option_1 = $request->option_1;   
        }

        if(!empty($request->option_img2)){
            $img2 = $request->option_img2->getClientOriginalName();
            $request->option_img2->move(public_path('files/gambar_jawaban'), $img2);
        	$soal->option_2 = $img2;    	
        }else{
            $soal->option_2 = $request->option_2;   
        }

        $soal->option_3 = $request->option_3;	
        if(!empty($request->option_img3)){
            $img3 = $request->option_img3->getClientOriginalName();
        	$soal->option_3 = $img3;
        	$request->option_img3->move(public_path('files/gambar_jawaban'), $img3);
        }
        $soal->option_4 = $request->option_4;	
        if(!empty($request->option_img4)){
            $img4 = $request->option_img4->getClientOriginalName();
        	$soal->option_4 = $img4;
        	$request->option_img4->move(public_path('files/gambar_jawaban'), $img4);
        }
        $soal->option_5 = $request->option_5;	
        if(!empty($request->option_img5)){
        	$img5 = $request->option_img5->getClientOriginalName();
            $soal->option_5 = $img5;
        	$request->option_img5->move(public_path('files/gambar_jawaban'), $img5);
        }
        if(!empty($request->key_answer)){
            $soal->right_answer = $request->key_answer;
        }
        if(!empty($request->esay_answer)){
            $soal->right_answer = $request->esay_answer;
        }
        $soal->pembahasan = $request->pembahasan;
        $soal->skor = $request->skor;
        $soal->id_kelas = $request->id_kelas;
        $soal->kd_mapel = $request->kd_mapel;
        $soal->save();
        return redirect('admin/kelola_soal/'.$request->id_kelas.'/'.$request->kd_mapel)->with('success','Berhasil Menambahkan Data Soal');
 	}

 	public function edit($id_soal)
 	{
		$isUpdate = true;
		$title = 'Edit Data Mapel';
 		$soal = soal::join('mapels','mapels.kd_mapel','=','soals.kd_mapel')
                    ->join('kelas','kelas.id_kelas','=','mapels.id_kelas')
                    ->where('soals.kd_soal',$id_soal)->first();
 		return view('Proktor.DataSoal.formdata',compact('isUpdate','title','soal'));
 	}

 	public function update(Request $request, $id)
 	{
 	    $soal = soal::findOrfail($id);
        $soal->soal = $request->soal;
        if(!empty($request->soal_file)){
            if(File::exists(public_path('files/file_soal/'.$soal->soal_file))){
                File::delete(public_path('files/file_soal/'.$soal->soal_file));
            }
            $soal->soal_file = $request->soal_file->getClientOriginalName();
            $request->soal_file->move(public_path('files/file_soal'), $soal->soal_file);
        }

        if(!empty($request->option_img1)){
            if(File::exists(public_path('files/gambar_jawaban/'.$soal->option_1))){
                File::delete(public_path('files/gambar_jawaban/'.$soal->option_1));
            }
            $img1 = $request->option_img1->getClientOriginalName();
            $request->option_img1->move(public_path('files/gambar_jawaban'), $img1);
            $soal->option_1 = $img1;        
        }else {
            $soal->option_1 = $request->option_1;   
        }

        if(!empty($request->option_img2)){
            if(File::exists(public_path('files/gambar_jawaban/'.$soal->option_2))){
                File::delete(public_path('files/gambar_jawaban/'.$soal->option_2));
            }
            $img2 = $request->option_img2->getClientOriginalName();
            $request->option_img2->move(public_path('files/gambar_jawaban'), $img2);
            $soal->option_2 = $img2;        
        }else{
            $soal->option_2 = $request->option_2;   
        }

        $soal->option_3 = $request->option_3;   
        if(!empty($request->option_img3)){
            if(File::exists(public_path('files/gambar_jawaban/'.$soal->option_3))){
                File::delete(public_path('files/gambar_jawaban/'.$soal->option_3));
            }
            $img3 = $request->option_img3->getClientOriginalName();
            $soal->option_3 = $img3;
            $request->option_img3->move(public_path('files/gambar_jawaban'), $img3);
        }
        $soal->option_4 = $request->option_4;   
        if(!empty($request->option_img4)){
            if(File::exists(public_path('files/gambar_jawaban/'.$soal->option_4))){
                File::delete(public_path('files/gambar_jawaban/'.$soal->option_4));
            }
            $img4 = $request->option_img4->getClientOriginalName();
            $soal->option_4 = $img4;
            $request->option_img4->move(public_path('files/gambar_jawaban'), $img4);
        }
        $soal->option_5 = $request->option_5;   
        if(!empty($request->option_img5)){
            if(File::exists(public_path('files/gambar_jawaban/'.$soal->option_5))){
                File::delete(public_path('files/gambar_jawaban/'.$soal->option_5));
            }
            $img5 = $request->option_img5->getClientOriginalName();
            $soal->option_5 = $img5;
            $request->option_img5->move(public_path('files/gambar_jawaban'), $img5);
        }
        if(!empty($request->key_answer)){
            $soal->right_answer = $request->key_answer;
        }
        if(!empty($request->esay_answer)){
            $soal->right_answer = $request->esay_answer;
        }
        $soal->pembahasan = $request->pembahasan;
        $soal->skor = $request->skor;
        $soal->id_kelas = $request->id_kelas;
        $soal->kd_mapel = $request->kd_mapel;
        $soal->save();
        return redirect('admin/kelola_soal/'.$request->id_kelas.'/'.$request->kd_mapel)->with('success','Berhasil Mengubah Data Soal');
 	}

 	public function delete($id)
 	{
 		$soal = soal::where('kd_soal',$id)->first();
 		if(File::exists(public_path('files/file_soal/'.$soal['soal_file']))){
 			File::delete(public_path('files/file_soal/'.$soal['soal_file']));
 		}
 		if(File::exists(public_path('files/gambar_jawaban/'.$soal['option_1']))){
 			File::delete(public_path('files/gambar_jawaban/'.$soal['option_1']));
 		}
 		if(File::exists(public_path('files/gambar_jawaban/'.$soal['option_2']))){
 			File::delete(public_path('files/gambar_jawaban/'.$soal['option_2']));
 		}
 		if(File::exists(public_path('files/gambar_jawaban/'.$soal['option_3']))){
 			File::delete(public_path('files/gambar_jawaban/'.$soal['option_3']));
 		}
 		if(File::exists(public_path('files/gambar_jawaban/'.$soal['option_4']))){
 			File::delete(public_path('files/gambar_jawaban/'.$soal['option_4']));
 		}
 		if(File::exists(public_path('files/gambar_jawaban/'.$soal['option_5']))){
 			File::delete(public_path('files/gambar_jawaban/'.$soal['option_5']));
 		}
 		$delSoal = soal::where('kd_soal',$id)->delete();		
 		return redirect()->back()->with('success','Berhasil Menghapus Data Mapel');
 	}

    public function lihat_soal($mapel)
    {
        $soal = soal::where('kd_mapel',$mapel)->get();
        $mapel = mapel::join('kelas','kelas.id_kelas','=','mapels.id_kelas')
            ->where('mapels.kd_mapel',$mapel)->first();
        return view('Proktor.DataSoal.LihatSoal',compact('soal','mapel'));
    }

    public function del_soal($mapel)
    {
        try {
			soal::where('kd_mapel',$mapel)->delete();
		} 
	   	catch (\Illuminate\Database\QueryException $e) {
	    	if($e->getCode() == "23000"){
				return back()->with('error','Gagal hapus data soal, Dikarenakan masih ada data nilai yang belum terhapus');
			}
		}
        return back()->with('success','Berhasil Menghapus Semua Soal');
    }

    public function print_soal($mapel)
    {
        $soal = soal::where('kd_mapel',$mapel)->get();
        $mapel = mapel::join('kelas','kelas.id_kelas','=','mapels.id_kelas')
            ->where('mapels.kd_mapel',$mapel)->first();
        $pdf = PDF::loadview('Proktor.DataSoal.PrintSoal',compact('soal','mapel'));
        return $pdf->stream();
    }

    public function import_soal()
    {
        if(Excel::import(new SoalImport,request()->file('soal_import'))){
            return back()->with('success','Berhasil Import Data Soal');
        }else{
            return back()->with('error','Gagal Import Data Soal Pastikan Format Excel Anda Sama Dengan Panduan.');
        }
        
    }
}
