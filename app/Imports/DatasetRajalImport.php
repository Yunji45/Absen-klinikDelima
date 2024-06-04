<?php

namespace App\Imports;

use App\Models\DatasetRajal;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DatasetRajalImport implements ToModel
{
    public function model(array $row)
    {
        if (count($row) < 5 || empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
            return null;
        }

        try {
            if (is_numeric($row[0])) {
                $tgl_kunjungan = Carbon::instance(Date::excelToDateTimeObject($row[0]))->format('Y-m-d H:i:s');
            } else {
                $tgl_kunjungan = Carbon::createFromFormat('d/m/Y H.i.s', $row[0])->format('Y-m-d H:i:s');
            }
        } catch (\Exception $e) {
            Log::error('Error during date conversion: ' . $e->getMessage());
            return null;
        }

        return new DatasetRajal([
            'tgl_kunjungan' => $tgl_kunjungan,
            'no_rm'         => $row[1],
            'name'          => $row[2],
            'poli'          => $row[3],
            'jenis_kelamin' => $row[4],
        ]);
    }
}
