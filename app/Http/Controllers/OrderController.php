<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukAir; // Ganti ke ProdukAir
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'alamat' => 'required|string',
            'quantity.*' => 'required|integer|min:0',
        ]);

        // Simpan data alamat ke session
        Session::put('order.alamat', $request->alamat);

        // Simpan produk yang dipilih beserta jumlahnya
        $orderItems = [];
        foreach ($request->quantity as $productId => $quantity) {
            if ($quantity > 0) {
                $product = ProdukAir::find($productId); // Ganti Produk jadi ProdukAir
                if ($product) {
                    $orderItems[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                    ];
                }
            }
        }

        // Simpan order items ke session
        Session::put('order.items', $orderItems);

        // Redirect ke halaman checkout
        return redirect()->route('checkout.index');
    }
}
