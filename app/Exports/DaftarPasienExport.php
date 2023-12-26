<?php

namespace App\Exports;

use App\Models\DaftarPasien;
use Maatwebsite\Excel\Concerns\FromCollection;

class DaftarPasienExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DaftarPasien::all();
    }
}
