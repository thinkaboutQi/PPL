<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        // Ambil semua order dengan relasi order_items
        $orders = Order::with('items.produkAir')->latest()->get();
        return view('history.historyorder', compact('orders'));
    }
}
