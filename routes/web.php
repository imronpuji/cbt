<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login','LoginController@login_proktor');
Route::post('/login_proktor', 'LoginController@post_login_proktor');
Route::get('/admin/logout', 'LoginController@logout_proktor');

Route::group(['middleware' => ['CekProktorLogin']], function(){
	Route::get('/admin','AdminController@index');
	// Proktor
	Route::get('/admin/proktor','ProktorController@index');
	Route::get('/admin/add_proktor','ProktorController@create');
	Route::post('/admin/store_proktor','ProktorController@store');
	Route::get('/admin/edit_proktor/{id}','ProktorController@edit');
	Route::put('/admin/update_proktor/{id}','ProktorController@update');
	Route::get('/admin/delete_proktor/{id}','ProktorController@delete');

	// Kelas
	Route::get('/admin/kelas', 'KelasController@index');
	Route::get('/admin/add_kelas','KelasController@create');
	Route::post('/admin/store_kelas','KelasController@store');
	Route::get('/admin/edit_kelas/{id}','KelasController@edit');
	Route::put('/admin/update_kelas/{id}','KelasController@update');
	Route::get('/admin/delete_kelas/{id}','KelasController@delete');

	// Siswa
	Route::get('/admin/siswa/{id}', 'SiswaController@index');
	Route::get('/admin/add_siswa/{id}','SiswaController@create');
	Route::post('/admin/store_siswa','SiswaController@store');
	Route::get('/admin/edit_siswa/{id}','SiswaController@edit');
	Route::put('/admin/update_siswa/{id}','SiswaController@update');
	Route::get('/admin/delete_siswa/{id}/{kls}','SiswaController@delete');
	Route::post('/admin/import_siswa', 'SiswaController@import_siswa');
	Route::get('/admin/export_siswa/{id_kelas}', 'SiswaController@export_siswa');
	Route::get('/admin/clear_siswa/{id_kelas}', 'SiswaController@clear');
	Route::get('/admin/cetak_kartu_ujian/{id_kelas}', 'SiswaController@cetak_kartu');

	// Mapel
	Route::get('/admin/mapel/{id}', 'MapelController@index');
	Route::get('/admin/add_mapel/{id}','MapelController@create');
	Route::post('/admin/store_mapel','MapelController@store');
	Route::get('/admin/edit_mapel/{id}','MapelController@edit');
	Route::put('/admin/update_mapel/{id}','MapelController@update');
	Route::get('/admin/delete_mapel/{id}/{kls}','MapelController@delete');

	// Soal
	Route::get('/admin/list_mapel/{id}', 'SoalController@index');
	Route::get('/admin/kelola_soal/{kls}/{mapel}', 'SoalController@soal');
	Route::get('/admin/add_soal/{kls}/{mapel}','SoalController@create');
	Route::post('/admin/store_soal','SoalController@store');
	Route::get('/admin/edit_soal/{id}','SoalController@edit');
	Route::put('/admin/update_soal/{id}','SoalController@update');
	Route::get('/admin/delete_soal/{soal}','SoalController@delete');
	Route::get('/admin/lihat_soal/{mapel}', 'SoalController@lihat_soal');
	Route::get('/admin/print_soal/{mapel}', 'SoalController@print_soal');
	Route::post('/admin/import_soal', 'SoalController@import_soal');
	Route::get('/admin/del_soal/{mapel}', 'SoalController@del_soal');

	// Nilai
	Route::get('/admin/list_mapel_nilai/{id}', 'NilaiController@index');
	Route::get('/admin/nilai_mapel/{mapel}/{kelas}', 'NilaiController@getNilai');
	Route::get('/admin/pengerjaan_ujian/{mapel}/{siswa}', 'NilaiController@PengerjaanSoal');
	Route::get('/admin/delete_nilai/{id}','NilaiController@delete');
	Route::get('/admin/cetak_pengerjaan/{mpl}/{sisw}', 'PrintController@CetakPengerjaan');
	Route::get('/admin/export_nilai/{kd_mapel}', 'NilaiController@export_nilai');
	Route::get('/admin/del_nilai_mapel/{kd_mapel}', 'NilaiController@hapus_semua_nilai');
	Route::get('/admin/del_nilai/{kd_mapel}/{siswa}', 'NilaiController@hapus_nilai');

	// Sesi Ujian
	Route::get('/admin/sesi_ujian','SesiUjianController@index');
	Route::get('/admin/add_sesiujian','SesiUjianController@create');
	Route::post('/admin/store_sesiujian','SesiUjianController@store');
	Route::get('/admin/edit_sesiujian/{id}','SesiUjianController@show');
	Route::put('/admin/update_sesiujian/{id}','SesiUjianController@update');
	Route::get('/admin/del_sesiujian/{id}','SesiUjianController@destroy');

	Route::get('/admin/sesi_siswa/{kls}','SesiSiswaController@index');
	Route::get('/admin/kelola_sesi/{kls}/{sesi}','SesiSiswaController@create_sesi');
	Route::get('/admin/del_sesi/{kls}/{sesi}','SesiSiswaController@destroy_sesi');
	Route::post('/admin/store_sesisiswa','SesiSiswaController@store');
	// Junk File
	Route::get('/admin/clear_junk_files', 'JunkFileController@clear');
});

Route::get('/test/login','LoginController@login_siswa');
Route::post('/login_siswa', 'LoginController@post_login_siswa');
Route::get('/test/logout', 'LoginController@logout_siswa');

Route::group(['middleware' => ['CekSiswaLogin']], function(){
	Route::get('/', 'TestController@welcome');
	Route::get('/welcome', 'TestController@welcome');
	Route::get('/test/detail/{id}', 'TestController@detail_ujian');
	Route::post('/test/start_ujian', 'TestController@start_ujian');
	Route::get('/test/soal/{mapel}/{no_soal}', 'TestController@getSoal');
	Route::post('/test/simpan', 'TestController@simpanSoal');
	Route::get('/test/konfirmasi/{mapel}', 'TestController@konfirmasi');
	Route::post('/test/selesai', 'TestController@finish');
});