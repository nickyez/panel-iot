<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    // Untuk menampilkan halaman temperature
    public function index()
    {
        return view('pages.temperature');
    }
}
