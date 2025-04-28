<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Mengambil data orderan dengan relasi barang
        $orders = Order::with('barang')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function exportAllPDF()
{
    // Ambil semua data order beserta relasi barang
    $orders = Order::with('barang')->get();

    // Load view PDF dan kirim data ke view
    $pdf = Pdf::loadView('orders.pdf_all', compact('orders'));

    // Download PDF
    return $pdf->download('Semua_Pesanan.pdf');
}


    public function create()
    {
        // Mengambil semua barang untuk ditampilkan pada form tambah order
        $barangs = Barang::all();
        return view('orders.create', compact('barangs'));
    }

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|numeric|min:1',
        'nama_pembeli' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:15',
        'total_harga' => 'required|numeric|min:1',  // Validasi total_harga
        'tanggal_pembelian' => 'required|date',
    ]);

    // Mengambil barang berdasarkan barang_id
    $barang = Barang::findOrFail($request->barang_id);
    $harga_satuan = $barang->harga;

    // Menghitung total harga
    $total_harga = $request->total_harga;

    // Mengecek jika stok cukup
    if ($barang->stok < $request->jumlah) {
        return redirect()->back()->with('error', 'Stok barang tidak mencukupi');
    }

    // Mengurangi stok barang
    $barang->stok -= $request->jumlah;
    $barang->save();

    // Menyimpan data order
    Order::create([
        'barang_id' => $request->barang_id,
        'jumlah' => $request->jumlah,
        'harga_satuan' => $harga_satuan,  // Menambahkan harga_satuan
        'total_harga' => $total_harga,
        'nama_pembeli' => $request->nama_pembeli,
        'no_telepon' => $request->no_telepon,
        'tanggal_pembelian' => $request->tanggal_pembelian,
    ]);

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil ditambahkan');
}



    public function show(string $id)
    {
        // Menampilkan detail order dengan relasi barang
        $order = Order::with('barang')->findOrFail($id);
        $barang = $order->barang; // ambil data barang dari relasi

        // Menghitung total harga jika perlu, meskipun sudah dihitung sebelumnya di controller store
        $total_harga = $order->jumlah * $order->harga_satuan;

        return view('orders.show', compact('order', 'total_harga', 'barang'));
    }

    public function exportPDF(string $id)
    {
        $order = Order::with('barang.category')->findOrFail($id);
        $barang = $order->barang;

        $pdf = Pdf::loadView('orders.pdf', compact('order', 'barang'));
        return $pdf->download('Detail_Pesanan_' . $order->id . '.pdf');
    }


    public function edit(string $id)
{
    // Ambil data order dan semua barang untuk dropdown
    $order = Order::with('barang')->findOrFail($id);
    $barangs = Barang::all();

    return view('orders.edit', compact('order', 'barangs'));
}

public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|numeric|min:1',
        'nama_pembeli' => 'required|string|max:255',
        'no_telepon' => 'required|string|max:15',
        'tanggal_pembelian' => 'required|date',
    ]);

    $order = Order::findOrFail($id);
    $oldBarang = Barang::findOrFail($order->barang_id);
    $newBarang = Barang::findOrFail($validated['barang_id']);

    $oldBarang->stok += $order->jumlah;
    $oldBarang->save();

    if ($newBarang->stok < $validated['jumlah']) {
        return back()->withErrors(['jumlah' => 'Stok barang tidak mencukupi.']);
    }

    $newBarang->stok -= $validated['jumlah'];
    $newBarang->save();

    $harga_satuan = $newBarang->harga;
    $total_harga = $validated['jumlah'] * $harga_satuan;

    $order->update([
        'barang_id' => $validated['barang_id'],
        'jumlah' => $validated['jumlah'],
        'harga_satuan' => $harga_satuan,
        'total_harga' => $total_harga,
        'nama_pembeli' => $validated['nama_pembeli'],
        'no_telepon' => $validated['no_telepon'],
        'tanggal_pembelian' => $validated['tanggal_pembelian'],
    ]);

    return redirect()->route('orders.index')->with('success', 'Order berhasil diperbarui.');
}




public function destroy(string $id)
{
    // Mengambil data order yang akan dihapus
    $order = Order::findOrFail($id);

    // Mengembalikan stok barang


    // Menghapus data order
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
}

}
