<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Umkm;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda KBB GO!.
     */
    public function index()
    {
        $featuredDestinasi = Destinasi::latest()->take(3)->get();
        $featuredUmkm = Umkm::latest()->take(4)->get();

        return view('home', compact('featuredDestinasi', 'featuredUmkm'));
    }
}
