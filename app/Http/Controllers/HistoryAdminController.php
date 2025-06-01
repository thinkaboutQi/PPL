<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class HistoryAdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('history.historyadmin', compact('orders'));
    }
}
