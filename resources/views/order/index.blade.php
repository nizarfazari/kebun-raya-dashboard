@extends('layouts.master')
@section('title', 'Laravel')

@section('content')
    <div class="section-header">
        <h1>Daftar Pesanan</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Pesanan </h4>
            <div class="card-header-action">
                <a href="#" class="btn btn-danger">View More <i class="fas fa-chevron-right"></i></a>
            </div>

        </div>
        <div class="card-body p-0">
            <div class="table-responsive table-invoice">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Total Transaksi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ bulan_teks($data->month) }}</td>
                                <td>{{ $data->year }}</td>
                                <td>{{ $data->total_transactions }}</td>
                                <td>
                                    <a
                                        href="{{ route('order.detail', ['month' => $data->month, 'year' => $data->year]) }}"
                                        class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

@endsection
@push('page-script')
    </script>
@endpush


@php
    function bulan_teks($bulan)
    {
        $bulan_teks = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulan_teks[$bulan];
    }
@endphp
