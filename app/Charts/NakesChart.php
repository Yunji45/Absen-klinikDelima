<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\DetailPegawai;

class NakesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $dokter = DetailPegawai::where('position','DOKTER')->count();
        $perawat = DetailPegawai::where('position','PERAWAT')->count();
        $bidan = DetailPegawai::where('position','BIDAN')->count();
        $apoteker = DetailPegawai::where('position','APOTEKER')->count();
        $ast_apoteker = DetailPegawai::where('position','Ast.APOTEKER')->count();
        $analys = DetailPegawai::where('position','ANALYS LAB')->count();
        $nutrisi = DetailPegawai::where('position','NUTRISIONIS')->count();

        return $this->chart
            ->pieChart()
            ->addData([$dokter, $perawat, $bidan, $apoteker, $ast_apoteker, $analys, $nutrisi])
            ->setLabels(['Dokter', 'Perawat', 'Bidan', 'Apoteker', 'Ast. Apoteker', 'Analys Lab', 'Nutrisionis']);
    }
}
