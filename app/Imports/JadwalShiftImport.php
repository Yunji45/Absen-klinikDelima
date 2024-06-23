<?php

namespace App\Imports;

use App\Models\jadwalterbaru;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class JadwalShiftImport implements ToModel
{
    /**
     * Process each row from the Excel file.
     *
     * @param array $row
     * @return \App\Models\jadwalterbaru|null
     */
    public function model(array $row)
    {
        if (count($row) < 34) {
            Log::error('Row has less than 34 columns: ' . json_encode($row));
            for ($i = count($row); $i < 34; $i++) {
                $row[$i] = null;
            }
        }

        $masa_aktif = $this->convertDate($row[2]);
        if ($masa_aktif === null) {
            Log::error('Error during date conversion for masa_aktif');
            return null;
        }

        $masa_akhir = $this->convertDate($row[3]);
        if ($masa_akhir === null) {
            Log::error('Error during date conversion for masa_akhir');
            return null;
        }

        $daily = [];
        for ($i = 1; $i <= 31; $i++) {
            $columnName = 'j' . $i;
            $daily[$columnName] = $row[3 + $i] ?? null;
        }

        return new jadwalterbaru(array_merge([
            'user_id' => $row[0],
            'bulan' => $row[1],
            'masa_aktif' => $masa_aktif,
            'masa_akhir' => $masa_akhir
        ], $daily));
    }

    /**
     * Convert the given date to 'Y-m-d H:i:s' format.
     *
     * @param mixed $date
     * @return string|null
     */
    private function convertDate($date)
    {
        try {
            if (is_numeric($date)) {
                return Carbon::instance(Date::excelToDateTimeObject($date))->format('Y-m-d H:i:s');
            } else {
                return Carbon::createFromFormat('d/m/Y H.i.s', $date)->format('Y-m-d H:i.s');
            }
        } catch (\Exception $e) {
            Log::error('Error during date conversion: ' . $e->getMessage());
            return null;
        }
    }
}
