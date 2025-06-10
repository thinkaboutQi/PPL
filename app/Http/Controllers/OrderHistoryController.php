<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['items.produkAir'])
            ->where('user_id', Auth::id());

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('produk')) {
            $produk = strtolower($request->produk);
            $query->whereHas('items.produkAir', function ($q) use ($produk) {
                $q->whereRaw('LOWER(nama_produk) LIKE ?', ['%' . $produk . '%']);
            });
        }

        $orders = $query->latest()->get();
        return view('history.historyorder', compact('orders'));
    }
}
