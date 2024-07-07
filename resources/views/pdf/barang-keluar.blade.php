<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Laporan Data Barang Keluar </h1>
    <table align="center" border="1px" style="width: 95%">
        <tr>
            <td>Barang Keluar</td>
            <td>Jumlah</td>
        </tr>
        @foreach ($barang_keluar as $product_name => $qty)
            <tr>
                <td>
                    {{ $product_name }}
                </td>
                <td>
                    {{ $qty }}
                </td>

            </tr>
        @endforeach
    </table>
</body>

</html>
