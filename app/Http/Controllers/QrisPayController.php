<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class QrisPayController extends Controller
{
    public function showQRISPayment($order_id)
    {
        
        $order = \App\Models\Order::find($order_id);
      
        if (!$order) {
            return redirect()->route('checkout.index')->with('error', 'Order tidak ditemukan.');
        }

        // Kirimkan data order ke view
        return view('payment.qris-pay', compact('order'));
    }
}
