@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Pesanan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Barang -->
                <div class="mb-3">
                    <label for="barang_id">Barang</label>
                    <select name="barang_id" id="barang_id" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}"
                                data-harga="{{ $barang->harga }}"
                                {{ $barang->id == $order->barang_id ? 'selected' : '' }}>
                                {{ $barang->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Pembelian -->
                <div class="mb-3">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" id="tanggal_pembelian" class="form-control"
                           value="{{ old('tanggal_pembelian', $order->tanggal_pembelian) }}" required>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control"
                           value="{{ old('jumlah', $order->jumlah) }}" required min="1">
                </div>

                <!-- Nama Pembeli -->
                <div class="mb-3">
                    <label for="nama_pembeli">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control"
                           value="{{ old('nama_pembeli', $order->nama_pembeli) }}" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-3">
                    <label for="no_telepon">Nomor Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon" class="form-control"
                           value="{{ old('no_telepon', $order->no_telepon) }}" required>
                </div>

                <!-- Hidden Total Harga -->
                <input type="hidden" name="total_harga" id="total_harga" value="{{ $order->total_harga }}">

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
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

        barangSelect.addEventListener('change', updateTotalHarga);
        jumlahInput.addEventListener('input', updateTotalHarga);

        function updateTotalHarga() {
            const selectedOption = barangSelect.options[barangSelect.selectedIndex];
            const hargaSatuan = selectedOption ? parseInt(selectedOption.dataset.harga) : 0;
            const jumlah = parseInt(jumlahInput.value) || 0;

            if (hargaSatuan > 0 && jumlah > 0) {
                const total = hargaSatuan * jumlah;
                totalHargaInput.value = total;
            } else {
                totalHargaInput.value = 0;
            }
        }

        // Trigger saat pertama kali untuk isi nilai total harga jika sudah ada data lama
        updateTotalHarga();
    });
</script>
@endsection
