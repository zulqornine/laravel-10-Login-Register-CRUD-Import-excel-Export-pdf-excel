<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_pembelian');
        $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
        $table->integer('jumlah')->default(1); // Menambahkan default value untuk jumlah
        $table->integer('harga_satuan');
        $table->integer('total_harga');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
