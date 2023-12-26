<?php

namespace App\Imports;

use App\Models\DaftarPasien;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class DaftarPasienImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        if (empty($row[1]) || empty($row[2]) || empty($row[3]) ) {
            return null;
        }
        try {
            // Dapatkan tanggal saat ini menggunakan Carbon
            $currentDate = Carbon::now();

            // Format tanggal saat ini ke dalam format 'Y-m-d'
            $formattedDate = $currentDate->format('Y-m-d');
        } catch (\Exception $e) {
            // Handle error if any
            Log::error('Error during date conversion: ' . $e->getMessage());
            return null;
        }

        // try {
        //     $formattedDate = date('Y-m-d', strtotime($row[0]));
        // } catch (\Exception $e) {
        //     return null;
        // }      

    
        return new DaftarPasien([
            'bulan'         => $formattedDate,
            'No_RM'         => $row[0],
            'nama_pasien'   => $row[1],
            'jenis_kelamin' => $row[2],
            'alamat'        => $row[3],
        ]);
    }
}
