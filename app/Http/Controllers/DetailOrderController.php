<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class DetailOrderController extends Controller
{
    public function index($id)
{
    $orders = \App\Models\Order::with('items.ProdukAir')->findOrFail($id);
    return view('detailorder/detailorder', compact('orders'));
}
}
