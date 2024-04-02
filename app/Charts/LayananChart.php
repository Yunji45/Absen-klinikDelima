<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class LayananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Trend Data Linear')
            ->setSubtitle('Pengunjung vs Digital sales.')
            ->addData('Pengunjung', [40, 93, 35, 42, 18, 82])
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->addData('Pengunjung', [45, 90, 34, 47, 14, 72])
            ->addData('Digital sales', [65, 19, 27, 26, 75, 85])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
