<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;
use App\Models\THR_lebaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class THRExport implements FromCollection, WithHeadings
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
        $tahun =date('Y');
        $data = THR_lebaran::whereYear('bulan', $tahun)
            ->orderBy('bulan', 'asc')
            ->get();
        // return $data;
        $numberedData = new Collection();
        foreach ($data as $key => $item) {
            $numberedData->push([
                'NO' => $key + 1,
                'NAMA' => $item->user->name,
                'THR' => 'Rp.' . number_format(floatval($item->THR), 0, ',', '.'),
                'TAHUN' => Carbon::parse($item->bulan)->year,
            ]);
        }
        return $numberedData;
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA',
            'THR',
            'TAHUN',
        ];
    }
}
