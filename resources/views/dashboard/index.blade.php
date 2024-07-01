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
                        10
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
                        10
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Ringkasan Penjualan</h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-invoice">
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah Produk terjual</th>
                        <th>Stock</th>
                    </tr>
                    <tr>
                        <td><a href="#">INV-87239</a></td>
                        <td class="font-weight-600">Kusnadi</td>
                        <td>
                            <div class="badge badge-warning">Unpaid</div>
                        </td>
                        <td>July 19, 2018</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">INV-48574</a></td>
                        <td class="font-weight-600">Hasan Basri</td>
                        <td>
                            <div class="badge badge-success">Paid</div>
                        </td>
                        <td>July 21, 2018</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">INV-76824</a></td>
                        <td class="font-weight-600">Muhamad Nuruzzaki</td>
                        <td>
                            <div class="badge badge-warning">Unpaid</div>
                        </td>
                        <td>July 22, 2018</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">INV-84990</a></td>
                        <td class="font-weight-600">Agung Ardiansyah</td>
                        <td>
                            <div class="badge badge-warning">Unpaid</div>
                        </td>
                        <td>July 22, 2018</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#">INV-87320</a></td>
                        <td class="font-weight-600">Ardian Rahardiansyah</td>
                        <td>
                            <div class="badge badge-success">Paid</div>
                        </td>
                        <td>July 28, 2018</td>
                        <td>
                            <a href="#" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
