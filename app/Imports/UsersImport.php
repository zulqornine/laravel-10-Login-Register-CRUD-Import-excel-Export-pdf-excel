<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        return new User([
            'name'  => $row['nama'],      // Kolom name di file Excel
            'email' => $row['email'],     // Kolom email di file Excel
            'password' => bcrypt('password'), // Password default (bisa sesuaikan)
        ]);
    }
}
