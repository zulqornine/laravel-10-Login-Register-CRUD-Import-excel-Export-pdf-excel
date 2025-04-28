@extends('layouts.main') {{-- atau layout kamu sendiri --}}
@section('content')
<div class="container">
    <h2>Detail Barang</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Barang:</strong> {{ $barang->nama }}</p>
            <p><strong>Kategori:</strong> {{ $barang->category->name }}</p>
            <p><strong>Harga:</strong> Rp{{ number_format($barang->harga, 0, ',', '.') }}</p>
            <p><strong>Stok:</strong> {{ $barang->stok }}</p>
            {{-- Tambahkan informasi lain jika ada --}}
        </div>
    </div>
    <a href="{{ route('barangs.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
