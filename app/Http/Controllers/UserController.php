<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get(); // ambil data user paling baru dulu
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function exportPDF()
    {
        $users = User::latest()->get();
        $pdf = Pdf::loadView('users.pdf', compact('users'));
        return $pdf->download('data_users.pdf');
    }

    public function import(Request $request)
{
    $file = $request->file('file'); // Nama input file Excel

    // Validasi jika email duplikat dalam file
    $data = Excel::toArray(new UsersImport, $file);
    $emails = array_column($data[0], 'email'); // Ambil kolom email

    // Cek duplikasi
    $duplicates = array_diff_assoc($emails, array_unique($emails));

    if (count($duplicates) > 0) {
        return back()->withErrors(['error' => 'Terdapat email yang duplikat']);
    }

    // Lanjutkan import jika tidak ada duplikasi
    Excel::import(new UsersImport, $file);
    return back()->with('success', 'Data berhasil diimpor!');
}


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}
