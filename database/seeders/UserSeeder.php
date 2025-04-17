<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //memasukan data ke tabel users
        User::create([
            'name' => 'rizqi',
            'email' => 'rizqi@gmail.com',
            'password' => bcrypt('rizqi123')
        ]);
    }
}
