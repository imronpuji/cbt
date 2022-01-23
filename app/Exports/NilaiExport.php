<?php

namespace App\Exports;

use App\nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $kd_mapel;
    function __construct($kd_mapel)
    {
    	$this->kd_mapel = $kd_mapel;
    }

    public function collection()
    {
        return nilai::join('mapels','mapels.kd_mapel','=','nilais.kd_mapel')
        	->join('siswas','siswas.id_siswa','=','nilais.id_siswa')
        	->join('kelas','kelas.id_kelas','=','siswas.id_kelas')
        	->where('nilais.kd_mapel',$this->kd_mapel)->get([
        		'siswas.nama','kelas.nm_kelas','mapels.nm_mapel','nilais.jumlah_jawaban_benar','nilais.jumlah_jawaban_salah','nilais.nilai'
        	]);
    }

    public function headings(): array
    {
    	return [
    		'Nama Siswa',
    		'Kelas',
    		'Mata Pelajaran',
    		'Jumlah Jawaban Benar',
    		'Jumlah Jawaban Salah',
    		'Skor'
    	];
    }
}
