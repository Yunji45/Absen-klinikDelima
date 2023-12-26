<?php

namespace App\Exports;

use App\Models\KategoriJasaMedis;
use Maatwebsite\Excel\Concerns\FromCollection;

class KategoriJasaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return KategoriJasaMedis::all();
    }
}
