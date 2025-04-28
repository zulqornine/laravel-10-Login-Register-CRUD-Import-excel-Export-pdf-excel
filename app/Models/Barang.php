<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'category_id', 'harga', 'stok'];


    // App\Models\Barang.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
