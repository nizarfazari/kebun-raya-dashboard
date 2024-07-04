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

            $totalBiayaProduct = Transaction::with('transaction_buyer')
                ->whereYear('transactions.created_at', $tahun)
                ->where('transactions.status', 'DITERIMA')
                ->whereMonth('transactions.created_at', $i)
                ->join('transaction_buyers', 'transactions.id', '=', 'transaction_buyers.transaction_id')
                ->selectRaw('SUM(transactions.total_biaya_product + transaction_buyers.cost_courier) as total_biaya')
                ->value('total_biaya');
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
