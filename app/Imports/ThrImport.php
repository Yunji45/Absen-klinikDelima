<?php

namespace App\Imports;

use App\Models\THR_lebaran;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ThrImport implements ToModel
{
    public function model(array $row)
    {
        if (count($row) < 4 || empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3])) {
            return null;
        }

        try {
            if (is_numeric($row[0])) {
                $tgl_kunjungan = Carbon::instance(Date::excelToDateTimeObject($row[1]))->format('Y-m-d H:i:s');
            } else {
                $tgl_kunjungan = Carbon::createFromFormat('d/m/Y H.i.s', $row[1])->format('Y-m-d H:i:s');
            }
        } catch (\Exception $e) {
            Log::error('Error during date conversion: ' . $e->getMessage());
            return null;
        }

        return new THR_lebaran([
            'user_id' => $row[0],
            'bulan'   => $tgl_kunjungan,
            'pendidikan' => $row[2],
            'THR' => $row[3]
        ]);
    }
}
