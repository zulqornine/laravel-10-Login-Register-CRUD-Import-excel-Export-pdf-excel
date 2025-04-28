<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="title">Detail Pesanan</div>

    <div class="section"><strong>Nama Pembeli:</strong> {{ $order->nama_pembeli }}</div>
    <div class="section"><strong>No. Telepon:</strong> {{ $order->no_telepon }}</div>
    <div class="section"><strong>Tanggal Pembelian:</strong> {{ $order->tanggal_pembelian }}</div>

    <hr>

    <div class="section"><strong>Nama Barang:</strong> {{ $barang->nama }}</div>
    <div class="section"><strong>Kategori:</strong> {{ $barang->category->name }}</div>
    <div class="section"><strong>Harga Satuan:</strong> Rp{{ number_format($order->harga_satuan, 0, ',', '.') }}</div>
    <div class="section"><strong>Jumlah:</strong> {{ $order->jumlah }}</div>
    <div class="section"><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 0, ',', '.') }}</div>
</body>
</html>
