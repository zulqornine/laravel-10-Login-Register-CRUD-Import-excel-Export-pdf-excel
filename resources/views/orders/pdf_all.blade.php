<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Semua Pesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Daftar Semua Pesanan</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pembelian</th>
                <th>Nama Pembeli</th>
                <th>No Telepon</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Barang</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal_pembelian)->format('d-m-Y') }}</td>
                    <td>{{ $order->nama_pembeli }}</td>
                    <td>{{ $order->no_telepon }}</td>
                    <td>{{ $order->barang->nama }}</td>
                    <td>{{ $order->jumlah }}</td>
                    <td>Rp{{ number_format($order->harga_satuan, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
