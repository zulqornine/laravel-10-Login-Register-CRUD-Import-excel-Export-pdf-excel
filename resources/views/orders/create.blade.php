@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Pesanan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <!-- Barang -->
                <div class="mb-3">
                    <label for="barang_id">Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" data-harga="{{ $barang->harga }}">
                                {{ $barang->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Tanggal Pembelian -->
                <div class="mb-3">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control" required>
                </div>


                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
                </div>

                <!-- Nama Pembeli -->
                <div class="mb-3">
                    <label for="nama_pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-3">
                    <label for="no_telepon">Nomor Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                </div>

                <!-- Hidden Total Harga -->
                <input type="hidden" name="total_harga" id="total_harga">

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const barangSelect = document.getElementById('barang_id');
        const jumlahInput = document.getElementById('jumlah');
        const totalHargaInput = document.getElementById('total_harga');

        // Update total harga ketika pilihan barang atau jumlah berubah
        barangSelect.addEventListener('change', updateTotalHarga);
        jumlahInput.addEventListener('input', updateTotalHarga);

        function updateTotalHarga() {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const hargaSatuan = selectedOption ? parseInt(selectedOption.dataset.harga) : 0;
            const jumlah = parseInt(jumlahInput.value) || 0;

            // Validasi agar total tidak menjadi negatif atau 0
            if (hargaSatuan > 0 && jumlah > 0) {
                const total = hargaSatuan * jumlah;
                totalHargaInput.value = total;
            } else {
                totalHargaInput.value = 0;  // Set ke 0 jika barang atau jumlah tidak valid
            }
        }
    });
</script>
@endsection
