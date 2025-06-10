<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function kirim($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'paid'; // atau 'shipping', tergantung penamaan kamu
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Pesanan berhasil dikirim.');
    }
}