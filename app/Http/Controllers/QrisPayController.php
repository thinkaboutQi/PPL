<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrisPayController extends Controller
{
    public function showQRISPayment()
    {
        // Ambil data order dari session
        $order = session('order');

        // Pastikan data order ada di session
        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order tidak ditemukan.');
        }

        // Kirimkan data order ke view
        return view('payment.qris-pay', compact('order'));
    }
}
