<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // menampilkan index
    public function index()
    {
        return view('index');
    }
}
