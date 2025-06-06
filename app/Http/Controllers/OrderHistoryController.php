<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        // Ambil semua order dengan relasi order_items
        $orders = Order::with(['items.produkAir'])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
        return view('history.historyorder', compact('orders'));
    }
}
