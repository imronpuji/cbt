<?php

namespace App\Http\Controllers;

use App\proktor;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProktorController extends Controller
{
	public function index()
	{
		$data = proktor::all();
		return view('Proktor.DataProktor.index',compact('data'));
	}

	public function create()
	{
		$isUpdate = false;
		$title = 'Tambah Data Proktor';
		return view('Proktor.DataProktor.formdata',compact('isUpdate','title'));
	}

	public function store(Request $request)
	{
		$request->validate([
            'username' => 'required',
            'password' => 'required|min:6'           
        ],
        [  
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password min 6 karakter'
        ]);

        $proktor = new proktor();
        $proktor->username = $request->username;
        $proktor->password = $request->password;
        $proktor->save();
        return redirect('admin/proktor')->with('success','Berhasil Menambahkan Data Proktor');
 	}

 	public function edit($id)
 	{
 		$isUpdate = true;
		$title = 'Tambah Data Proktor';
 		$proktor = proktor::findOrfail($id);
 		return view('Proktor.DataProktor.formdata',compact('isUpdate','title','proktor'));
 	}

 	public function update(Request $request, $id)
 	{
 		$request->validate([
            'username' => 'required',
            'password' => 'required|min:6'           
        ],
        [  
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password min 6 karakter'
        ]);

 		$proktor = proktor::findOrfail($id);
 		$proktor->username = $request->username;
 		$proktor->password = $request->password;
 		$proktor->save();
 		return redirect('admin/proktor')->with('success','Berhasil Mengubah Data Proktor');
 	}

 	public function delete($id)
 	{
 		$proktor = proktor::where('id_proktor',$id)->delete();
 		return redirect('admin/proktor')->with('success','Berhasil Menghapus Data Proktor');
 	}

}
