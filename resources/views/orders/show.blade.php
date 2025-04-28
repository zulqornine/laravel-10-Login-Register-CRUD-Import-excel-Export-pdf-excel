@extends('layouts.main')
@section('content')
<div class="container">
    <h2>Detail Pesanan</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Pembeli:</strong> {{ $order->nama_pembeli }}</p>
            <p><strong>No. Telepon:</strong> {{ $order->no_telepon }}</p>
            <p><strong>Tanggal Pembelian:</strong> {{ $order->tanggal_pembelian }}</p>
            <hr>
            <p><strong>Nama Barang:</strong> {{ $barang->nama }}</p>
            <p><strong>Kategori:</strong> {{ $barang->category->name }}</p>
            <p><strong>Harga Satuan:</strong> Rp{{ number_format($order->harga_satuan, 0, ',', '.') }}</p>
            <p><strong>Jumlah:</strong> {{ $order->jumlah }}</p>
            <p><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary m-1">Kembali</a>
        <a href="{{ route('orders.exportPDF', $order->id) }}" class="btn btn-primary m-1">Cetak PDF</a>

    </div>
</div>

{{-- CSS Print --}}
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .container, .container * {
            visibility: visible;
        }
        .container {
            position: absolute;
            left: 0;
            top: 0;
        }
        .btn {
            display: none !important;
        }
    }
</style>
@endsection
