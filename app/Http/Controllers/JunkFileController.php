<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class JunkFileController extends Controller
{
	public function clear()
	{
		DB::table('history_pengerjaans')->delete();
		DB::table('start_ujians')->delete();
		DB::table('soal_temps')->delete();
	    return back()->with('success','Berhasil Menkosongkan Data Junk Files');
	}
}
