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
            <h1 class="h3 mb-0 text-gray-800">Barang</h1>
        </div>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Barang</h6>
                <div class="d-flex">
                    <a href="{{ route('barangs.create') }}" class="btn btn-primary btn-sm m-1">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                    <a href="{{ route('barangs.pdf') }}" target="_blank" class="btn btn-danger btn-sm m-1">
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
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barangs as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->nama }}</td>
                                    <td>{{ $barang->category->name ?? 'Kategori tidak tersedia' }}
                                    </td>
                                    <td>Rp{{ number_format($barang->harga, 0, ',', '.') }}</td>
                                    <td>{{ $barang->stok }}</td>
                                    <td>
                                        <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('barangs.show', $barang->id) }}" class="btn btn-info btn-sm m-1">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="#" class="btn btn-danger btn-delete btn-sm" data-id="{{ $barang->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                        <form id="delete-form-{{ $barang->id }}" action="{{ route('barangs.destroy', $barang->id) }}" method="POST" style="display: none;">
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
