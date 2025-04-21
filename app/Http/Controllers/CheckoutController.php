<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string',
            'provinsi' => 'required|string',
            'alamat' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        // Simulasi simpan ke database (atau bisa dikirim ke model Order)
        $data = $request->all();

        // Contoh response
        return redirect()->route('checkout.index')->with('success', 'Pesanan berhasil dibuat!');
    }
}
