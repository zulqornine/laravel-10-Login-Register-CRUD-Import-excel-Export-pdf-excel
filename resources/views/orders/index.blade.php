@extends('layouts.main')

@section('content')

    <div class="m-3">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pembelian / Orderan</h1>
        </div>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pembelian</h6>
                <div class="d-flex">
                    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm m-1">
                        <i class="fas fa-plus"></i> Tambah Order
                    </a>
                    <a href="{{ route('orders.pdf') }}" target="_blank" class="btn btn-danger btn-sm m-1">
                        <i class="fas fa-file-pdf"></i> Cetak PDF
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->tanggal_pembelian)->format('d-m-Y') }}</td>

                                    <td>{{ $order->nama_pembeli }}</td> <!-- Menampilkan Nama Pembeli -->
                                    <td>{{ $order->no_telepon }}</td> <!-- Menampilkan No Telepon -->
                                    <td>{{ $order->barang->nama }}</td> <!-- Nama Barang -->
                                    <td>{{ $order->jumlah }}</td> <!-- Jumlah Barang -->
                                    <td>Rp{{ number_format($order->harga_satuan, 0, ',', '.') }}</td> <!-- Harga Satuan Barang -->
        <td>Rp{{ number_format($order->total_harga ?? 0, 0, ',', '.') }}</td> <!-- Total Harga -->
 <!-- Total Harga -->
                                    <td>
                                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm m-1">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="#" class="btn btn-danger btn-delete btn-sm" data-id="{{ $order->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                        <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
