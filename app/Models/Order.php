<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan hanya menyertakan kolom yang relevan
    protected $fillable = ['tanggal_pembelian', 'harga_barang', 'total_harga', 'barang_id', 'nama_pembeli', 'no_telepon', 'jumlah', 'harga_satuan'];


    // Menambahkan event untuk menghitung total harga

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
