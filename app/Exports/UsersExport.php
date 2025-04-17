<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    // Mengatur header Excel
    public function headings(): array
    {
        return [
            'No',     // Nomor Urut
            'Nama',   // Nama
            'Email',  // Email
        ];
    }

    // Menyusun data untuk setiap baris, termasuk nomor urut
    public function map($user): array
    {
        return [
            $user->id,          // Nomor urut berdasarkan ID
            $user->name,        // Nama
            $user->email,       // Email
        ];
    }
}
