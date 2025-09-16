<?php

namespace App\Http\Controllers;
use App\Models\Laporan;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home.index');
    }

    public function about()
    {
        return view('pages.home.about');
    }

    public function show_laporan(Laporan $laporan)
    {
        return view('pages.home.show_laporan', compact('laporan'));
    }
}
