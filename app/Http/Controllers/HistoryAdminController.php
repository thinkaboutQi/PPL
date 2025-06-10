<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class HistoryAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->get();
        return view('history.historyadmin', compact('orders'));
    }
}
