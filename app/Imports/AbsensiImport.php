<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;
use App\Models\presensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class AbsensiImport implements ToModel
{
    public function model(array $row)
    {
        if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
            throw new \Exception('Some required fields are missing');
        }        
        
        return new presensi([
            'user_id' => $row[0],
            'keterangan' => $row[1],
            'tanggal' => now(),
            'jam_masuk' => null,
            'jam_keluar' => null
        ]);
    }    
}
