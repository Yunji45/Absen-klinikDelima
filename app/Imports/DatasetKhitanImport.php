<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DatasetKhitanImport implements ToModel
{
    public function model(array $row)
    {
        if (empty($row[0]) || ($row[1]) || empty($row[2]) || empty($row[3]) ) {
            return null;
        }
        try {
            // Dapatkan tanggal saat ini menggunakan Carbon
            $currentDate = Carbon::now();
            $formattedDate = $currentDate->format('Y-m-d');
        } catch (\Exception $e) {
            // Handle error if any
            Log::error('Error during date conversion: ' . $e->getMessage());
            return null;
        }
        return new DatasetKhitan([
            'tgl_kunjungan' => $row[0],
            'no_rm'         => $row[1],
            'name'          => $row[2],
            'poli'          => $row[3],
            'jenis_kelamin' => $row[4],
        ]);
    
    }
}
