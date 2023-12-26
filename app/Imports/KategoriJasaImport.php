<?php

namespace App\Imports;

use App\Models\KategoriJasaMedis;
use Maatwebsite\Excel\Concerns\ToModel;

class KategoriJasaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KategoriJasaMedis([
            'jenis_layanan'     => $row[0],
            'jenis_jasa'    => $row[1],
            'tarif_jasa' => $row[2],
        ]);
    }
}
