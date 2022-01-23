<?php

namespace App\Imports;

use App\siswa;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new siswa([
            'nis' => $row[0],
            'nama' => $row[1],
            'id_kelas' => $row[2],
            'password' => $row[4],
        ]);
    }
}
