@extends('layouts.master')
@section('title', 'Laravel')
@section('content')

    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Users</h4>
                    </div>
                    <div class="card-body">
                        10
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Category</h4>
                    </div>
                    <div class="card-body">
                        {{ $categories }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Transaksi</h4>
                    </div>
                    <div class="card-body">
                        {{ $transaction->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Product</h4>
                    </div>
                    <div class="card-body">
                        47
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Penjualan Hari ini</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalCostForCurrentMonth }}
                    </div>
                </div>
            </div>
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Penjualan </h4>
                    </div>
                    <div class="card-body">
                        {{ $totalProfit }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Transaksi Terbaru</h4>
        
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-invoice">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th>Invoice ID</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Total Harga</th>
                            <th>Due Date</th>
                            <th>No Resi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction as $d)
                            <tr>
                                <td>
                                    <div>{{ $d->order_id_midtrans }}</div>
                                </td>
                                <td class="font-weight-600">{{ $d->transaction_buyer->first_name }}
                                    {{ $d->transaction_buyer->last_name }}</td>
                                <td>
                                    @if ($d->status == 'PENDING')
                                        <div class="badge badge-primary">PENDING</div>
                                    @elseif($d->status == 'SUDAH-DIBAYAR')
                                        <div class="badge badge-info">SUDAH DIBAYAR</div>
                                    @elseif($d->status == 'DIKIRIM')
                                        <div class="badge badge-warning">MENUNGGU DITERIMA</div>
                                    @elseif($d->status == 'DITERIMA')
                                        <div class="badge badge-success">DITERIMA</div>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $d->total_biaya_product + $d->biaya_pengiriman }}</div>
                                </td>
                                <td>{{ $d->created_at }}</td>
                                <td>
                                    @if ($d->receipt)
                                        <p class="mb-0">{{ $d->receipt->no_receipt }}</p>
                                    @else
                                        <p>No Resi Belum Di inputkan</p>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
