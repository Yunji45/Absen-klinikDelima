<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use App\Models\gajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiExport implements FromCollection
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
            'bulan' => ['required']
        ]);
        $waktu = explode('-', request()->bulan);
    
        $data = gajian::whereMonth('bulan', $waktu[1])
            ->whereYear('bulan', $waktu[0])
            ->orderBy('bulan', 'asc')
            ->get();
        // return $data;
        $numberedData = new Collection();
        foreach ($data as $key => $item) {
            $numberedData->push([
                'No' => $key + 1,
                'Nama' => $item->user->name,
                'Gaji' => 'Rp.' . number_format(floatval($item->Gaji_akhir), 0, ',', '.'),
                'Date' => $item->bulan,
            ]);
        }

        return $numberedData;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Gaji',
            'Date',
        ];
    }
}
