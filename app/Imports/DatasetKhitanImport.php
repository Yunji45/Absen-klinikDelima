<?php

namespace App\Imports;

use App\Models\DatasetKhitan;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DatasetKhitanImport implements ToModel
{
    public function model(array $row)
    {
        if (count($row) < 5 || empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
            return null;
        }
        
        try {
            $tgl_kunjungan = Carbon::createFromFormat('d/m/Y H.i.s', $row[0])->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            // Handle error if any
            Log::error('Error during date conversion: ' . $e->getMessage());
            return null;
        }

        $data = new DatasetKhitan([
            'tgl_kunjungan' => $tgl_kunjungan,
            'no_rm'         => $row[2],
            'name'          => $row[3],
            'poli'          => $row[1],
            'jenis_kelamin' => $row[4],
        ]);

        $data->save();
        return $data;
    
    }
}