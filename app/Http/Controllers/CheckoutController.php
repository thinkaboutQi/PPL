<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProdukAir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        $order = Session::get('order');  // Mengambil data order yang ada di session
        return view('checkout', compact('order'));
    }

    // Proses pembuatan order
    public function process(Request $request)
    {
        // Validasi form input
        $request->validate([
            'nama' => 'required|string',
            'telp' => 'required|string',
            'alamat' => 'required|string',
            'products.*.id' => 'required|integer',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Hitung total harga dan buat array item produk
        $totalAmount = 0;
        $items = [];
        foreach ($request->products as $product) {
            $produkModel = ProdukAir::find($product['id']);
            $harga = $produkModel->harga;
            $totalAmount += $harga * $product['quantity'];  // Menghitung total harga
            $items[] = [
                'produk_air_id' => $product['id'],  // Menggunakan produk_air_id
                'quantity' => $product['quantity'],
                'harga_satuan' => $harga,
            ];
        }

        // Simpan data order utama ke dalam tabel orders
        $order = Order::create([
            'user_id' => $user->id ?? null,
            'nama' => $request->nama,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
            'pin_alamat' => $request->pin_alamat,
            'catatan_pesanan' => $request->catatan_pesanan,
            'total_harga' => $totalAmount,
            'status' => 'pending',
        ]);

        // Simpan detail produk ke dalam tabel order_items
        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_air_id' => $item['produk_air_id'],  // Pastikan ini diisi dengan benar
                'quantity' => $item['quantity'],
                'harga_satuan' => $item['harga_satuan'],
            ]);
        }

        // Bersihkan session order setelah berhasil disimpan
        Session::forget('order');

        // Redirect ke halaman pembayaran QRIS atau halaman lain sesuai kebutuhan
        return redirect()->route('order.qris-payment', ['order_id' => $order->id])->with('success', 'Order berhasil dibuat!');
    }

    // Konfirmasi order dan alihkan ke halaman pembayaran QRIS
    public function confirm(Request $request)
    {
        // Proses konfirmasi order jika perlu
        // (Misalnya update status atau simpan data tambahan, jika ada)

        // Redirect ke halaman pembayaran QRIS
        return redirect()->route('order.qris-payment')->with('success', 'Order berhasil dikonfirmasi!');
    }
}