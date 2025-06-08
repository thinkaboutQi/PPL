<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukAir; // Ganti ke ProdukAir
use App\Models\Order; // Pastikan kamu menggunakan model Order untuk menyimpan data order
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'alamat' => 'required|string',
            'quantity.*' => 'required|integer|min:0',
        ]);

        // Simpan data alamat ke session
        Session::put('order.alamat', $request->alamat);

        // Simpan produk yang dipilih beserta jumlahnya
        $orderItems = [];
        foreach ($request->quantity as $productId => $quantity) {
            if ($quantity > 0) {
                $product = ProdukAir::find($productId); // Ganti Produk jadi ProdukAir
                if ($product) {
                    $orderItems[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                    ];
                }
            }
        }

        // Simpan order items ke session
        Session::put('order.items', $orderItems);

        // Hitung total amount
        $totalAmount = 0;
        foreach ($orderItems as $item) {
            $totalAmount += $item['product']->harga * $item['quantity']; // Sesuaikan dengan atribut harga produk
        }

        // Simpan total amount ke session
        Session::put('order.total_amount', $totalAmount);

        // Redirect ke halaman checkout
        return redirect()->route('checkout');
    }

    public function confirm($orderId)
    {
        // Ambil data order berdasarkan ID
        $order = Order::findOrFail($orderId);

        // Lakukan proses konfirmasi (misalnya update status order)
        $order->status = 'confirmed';  // Sesuaikan dengan field dan logika yang ada di aplikasi kamu
        $order->save();

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('checkout')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function history()
    {
        $user = auth()->user();

        // Ambil semua order milik user yang sedang login
        $orders = \App\Models\Order::with('items.product')->where('user_id', $user->id)->latest()->get();

        return view('order.history', compact('orders'));
    }
}
