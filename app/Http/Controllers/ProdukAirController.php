<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukAir;

class ProdukAirController extends Controller
{
    public function index()
    {
        $produk = ProdukAir::all();
        return view('order', compact('produk'));
    }

    
}
