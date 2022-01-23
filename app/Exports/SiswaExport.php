<?php

namespace App\Exports;

use App\siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id_kelas;
    function __construct($id_kelas)
    {
    	$this->id_kelas = $id_kelas;
    }

    public function collection()
    {
        return siswa::join('kelas','kelas.id_kelas','=','siswas.id_kelas')
        	->where('siswas.id_kelas',$this->id_kelas)->get([
        	'nama','nm_kelas','password'
        ]);
    }

    public function headings(): array
    {
    	return [
    		'Nama Siswa',
    		'Kelas',
    		'Password'
    	];
    }
}
