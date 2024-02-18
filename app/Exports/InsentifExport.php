<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use App\Models\InsentifKpi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InsentifExport implements FromCollection, WithHeadings
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
    
        $data = InsentifKpi::whereMonth('bulan', $waktu[1])
            ->whereYear('bulan', $waktu[0])
            ->orderBy('bulan', 'asc')
            ->get();
        // return $data;
        $numberedData = new Collection();
        foreach ($data as $key => $item) {
            $numberedData->push([
                'No' => $key + 1,
                'Nama' => $item->user->name,
                'Poin' => $item->poin_user,
                'Insentif Yang Di Terima' => 'Rp.' . number_format(floatval($item->insentif_final), 0, ',', '.'),
                'Date' => $item->bulan,
            ]);
        }

        return $numberedData;
    }

    /**
    * @return array
    */

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Poin',
            'Insentif Yang Di Terima',
            'Date',
        ];
    }
}
