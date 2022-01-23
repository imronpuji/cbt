<?php

namespace App\Http\Controllers;

use App\siswa, App\kelas, App\proktor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    
	public function login_siswa()
	{
		return view('Siswa.Login.index');
	}

    public function login_proktor()
    {
        return view('Proktor.Login.index');
    }

    public function post_login_siswa(Request $request)
    {
    	$nis = $request->nis;
    	$password = $request->password;
    	$cek_siswa = siswa::where('nis',$nis)->where('password',$password)->count();
    	$data_siswa = siswa::where('nis',$nis)->where('password',$password)->first();
    	if($cek_siswa > 0){
    		$kls = kelas::where('id_kelas',$data_siswa->id_kelas)->first();
    		Session::put('id_siswa', $data_siswa->id_siswa);
    		Session::put('nis', $data_siswa->nis);
            Session::put('id_kelas',$data_siswa->id_kelas);
    		Session::put('nama', $data_siswa->nama);
    		Session::put('kelas', $kls->nm_kelas);
            Session::put('is_siswa_login', true);
    		return redirect('/welcome');
    	}else{
    		return redirect('test/login')->with('error','Periksa Nomor Induk dan Password Anda');
    	}
    }

    public function logout_siswa()
    {
    	Session::flush();
    	return redirect('test/login')->with('error','Anda Telah Logout');
    }

     public function post_login_proktor(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $cek_proktor = proktor::where('username',$username)->where('password',$password)->count();
        $data_proktor = proktor::where('username',$username)->where('password',$password)->first();
        if($cek_proktor > 0){
            Session::put('id_proktor', $data_proktor->id_proktor);
            Session::put('username', $data_proktor->username);
            Session::put('is_proktor_login', true);
            return redirect('/admin');
        }else{
            return redirect('/admin/login')->with('error','Periksa Username dan Password Anda');
        }
    }

    public function logout_proktor()
    {
        Session::flush();
        return redirect('/admin/login')->with('error','Anda Telah Logout');
    }
}
