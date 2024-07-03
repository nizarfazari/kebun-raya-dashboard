<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{ $data }}
    <h1>Laporan Data Penjualan Bulan </h1>
    <table align="center" border="1px" style="width: 95%">
        <tr>
            <td>Barang Keluar</td>
            <td>Jumlah</td>
            <td>Total Penjualan</td>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>
                    <ul>
                        @foreach ($item->detail as $val)
                            <li>{{ $val->product->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    @foreach ($item->detail as $val)
                        <li>{{ $val->qty }}</li>    
                    @endforeach
                </td>
                <td>{{ $item->total_biaya_product + $item->biaya_pengiriman }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
