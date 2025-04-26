<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        // Ambil semua data order dari session
        $order = Session::get('order');

        return view('checkout', compact('order'));
    }

    public function confirm(Request $request)
    {
        // Misal kamu mau konfirmasi checkout di sini
        Session::forget('order');

        return redirect()->route('order')->with('success', 'Order berhasil dikonfirmasi!');
    }
}
