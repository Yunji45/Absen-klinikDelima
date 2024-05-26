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
    // public function model(array $row)
    // {
    //     if (count($row) < 5 || empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
    //         return null;
    //     }
        
    //     try {
    //         $tgl_kunjungan = Carbon::createFromFormat('d/m/Y H.i.s', $row[0])->format('Y-m-d H:i:s');
    //     } catch (\Exception $e) {
    //         // Handle error if any
    //         Log::error('Error during date conversion: ' . $e->getMessage());
    //         return null;
    //     }

    //     $data = new presensi([
    //         'user_id' => $row[1],
    //         'keterangan'         => $row[2],
    //         'tanggal'          => $tgl_kunjungan,
    //         'jam_masuk'          => $row[3],
    //         'jam_keluar' => $row[4],
    //     ]);

    //     $data->save();
    //     return $data;
    // }

    public function model(array $row)
    {
        return new presensi([
            'user_id' => $row[0],
            'keterangan' => $row[1],
            'tanggal' =>now(),
            'jam_masuk' => $row[2],
            'jam_keluar' => $row[3]
        ]);
    }
}
