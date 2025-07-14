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

    public function sendInvoice(Request $request, $order)
    {
        $order = \App\Models\Order::with(['user', 'items.ProdukAir'])->findOrFail($order);
        $user = $order->user;
        try {
            \Mail::to($user->email)->send(new \App\Mail\InvoiceMail($order));
            return redirect()->back()->with('success', 'Invoice berhasil dikirim ke user.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim invoice: ' . $e->getMessage());
        }
    }
}