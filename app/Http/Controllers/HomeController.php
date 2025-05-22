<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukAir; // Tambahkan ini agar bisa akses model ProdukAir

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Ambil semua data produk air dari database
        $produk = ProdukAir::all();

        // Kirim data ke view 'home'
        return view('dashboard/home', compact('produk'));
    }
}
