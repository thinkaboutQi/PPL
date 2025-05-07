<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpanAlamatController extends Controller
{
    // Menampilkan form di halaman checkout
    public function index()
    {
        return view('checkout');
    }

    // Menyimpan data alamat yang diinputkan oleh user
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'telp' => 'required|numeric|min:10',
            'catatan_pesanan' => 'nullable|string|max:1000',
            'alamat' => 'required|string|max:500',
            'kode_pos' => 'required|numeric|digits_between:5,6',
        ]);

        // Simpan data ke session agar bisa digunakan di halaman berikutnya
        session(['order' => $validated]);

        // Redirect ke halaman checkout dengan pesan sukses
        return redirect()->route('checkout.index')->with('success', 'Alamat berhasil disimpan');
    }

    // Proses pemesanan
    public function order(Request $request)
    {
        // Ambil data alamat dari session
        $order = session('order');

        // Jika alamat belum ada, kembalikan ke halaman checkout untuk melengkapi alamat
        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Anda harus memasukkan alamat terlebih dahulu.');
        }

        // Proses pemesanan, misalnya menyimpan order ke database
        // Contoh: Order::create($order);

        // Redirect ke halaman pembayaran
        return redirect()->route('payment.index')->with('success', 'Pemesanan berhasil, lanjutkan ke pembayaran');
    }
}
