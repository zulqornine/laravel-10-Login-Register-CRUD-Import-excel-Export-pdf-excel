<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::latest()->get();
        return view('barangs.index', compact('barangs'));
    }

    public function exportPDF()
    {
        $barangs = Barang::all();
        $pdf = Pdf::loadView('barangs.pdf', compact('barangs'));
        return $pdf->download('barang-list.pdf');
    }

    public function create()
    {
        $categories = Category::all();
        return view('barangs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'category_id' => 'required|exists:categories,id',  // kolom relasi yang benar
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        Barang::create($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('barangs.show', compact('barang'));
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $categories = Category::all();
        return view('barangs.edit', compact('barang', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'category_id' => 'required|exists:categories,id',  // kolom relasi yang benar
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil dihapus.');
    }
}
