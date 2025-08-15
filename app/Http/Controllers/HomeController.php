<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;

class HomeController extends Controller
{
    public function index()
    {
        $laporans = Laporan::all();
        return view('pages.home.index', compact('laporans'));
    }
}
