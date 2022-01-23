<?php

namespace App\Imports;

use App\soal;
use Maatwebsite\Excel\Concerns\ToModel;

class SoalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new soal([
            'soal' => $row[0],
            'option_1' => $row[1],
            'option_2' => $row[2],
            'option_3' => $row[3],
            'option_4' => $row[4],
            'option_5' => $row[5],
            'right_answer' => $row[6],
            'pembahasan' => $row[7],
            'skor' => $row[8],
            'kd_mapel' => $row[9],
            'id_kelas' => $row[10]
        ]);
    }
}
