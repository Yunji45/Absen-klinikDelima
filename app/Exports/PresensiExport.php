<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use App\Models\presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PresensiExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $validator = Validator::make(request()->all(), [
            'tanggal' => ['required']
        ]);
        $waktu = explode('-', request()->tanggal);
    
        $data = presensi::whereMonth('tanggal', $waktu[1])
            ->whereYear('tanggal', $waktu[0])
            ->orderBy('tanggal', 'asc')
            ->get();
        // return $data;
        $numberedData = new Collection();
        foreach ($data as $key => $item) {
            $numberedData->push([
                'No' => $key + 1,
                'user_id' => $item->id,
                'keterangan' => $item->keterangan,
                'jam_masuk' => $item->jam_masuk,
                'jam_keluar' => $item->jam_keluar,
                'tanggal' => $item->tanggal
            ]);
        }
        return $numberedData;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Keterangan',
            'Jam_Masuk',
            'Jam_Keluar',
            'Tanggal',
        ];
    }
}
