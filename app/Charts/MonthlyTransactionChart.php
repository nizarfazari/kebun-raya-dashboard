<?php

namespace App\Charts;

use App\Models\Transaction;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MonthlyTransactionChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {

        $tahun = date('Y');
        $bulan = date('m');
        
        for ($i = 1; $i <= $bulan; $i++) {
            $totalBiayaProduct = Transaction::whereYear('created_at', $tahun)->where('status', 'DITERIMA')->whereMonth('created_at', $i) ->selectRaw('SUM(total_biaya_product + biaya_pengiriman) as total_biaya')->value('total_biaya');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalBiaya[] = $totalBiayaProduct;
        }

        return $this->chart->lineChart()
            ->setTitle('Data Penjualan Produk')
            ->setSubtitle('Total Penerimaan Biaya Produk')
            ->addData('Total Biaya Produk', $dataTotalBiaya)
            ->setHeight(500)
            ->setXAxis($dataBulan);
    }
}
